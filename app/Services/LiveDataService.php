<?php

namespace App\Livewire;
namespace App\Services;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class LiveDataService
{
    /**
     * Get Live Headlines from GNews (or fallback to DB/Simulated)
     */
    public function getHeadlines()
    {
        return Cache::remember('live_headlines', 300, function () { // 5 mins
            try {
                $apiKey = env('GNEWS_API_KEY');
                if ($apiKey) {
                    $response = Http::timeout(3)->get("https://gnews.io/api/v4/top-headlines?token={$apiKey}&lang=en&country=in");
                    if ($response->successful() && isset($response['articles'])) {
                        return array_map(function($article) {
                            return [
                                'title' => $article['title'],
                                'url' => $article['url'],
                                'source' => $article['source']['name'],
                                'time' => Carbon::parse($article['publishedAt'])->diffForHumans(),
                                'image' => $article['image'] ?? null
                            ];
                        }, array_slice($response['articles'], 0, 8));
                    }
                }
            } catch (\Exception $e) {}

            return []; // Return empty, view handles fallback to DB posts
        });
    }

    /**
     * Get Trending Searches from Google Trends (RSS)
     */
    public function getTrendingSearches()
    {
        return Cache::remember('live_trends', 3600, function () { // 1 hour
            try {
                $response = Http::timeout(5)->get('https://trends.google.com/trends/trendingsearches/daily/rss?geo=IN');
                if ($response->successful()) {
                    $xml = simplexml_load_string($response->body());
                    $trends = [];
                    foreach ($xml->channel->item as $item) {
                        $trends[] = (string)$item->title;
                        if (count($trends) >= 10) break;
                    }
                    return $trends;
                }
            } catch (\Exception $e) {}

            return ['Election 2026', 'Cricket World Cup', 'Sensex', 'Gold Rate', 'Technology', 'AI Future']; // Fallback
        });
    }

    /**
     * Get Current Weather for Header (OpenWeather)
     */
    public function getWeather($city = 'New Delhi')
    {
        return Cache::remember("live_weather_{$city}", 1800, function () use ($city) { // 30 mins
            try {
                $apiKey = env('OPENWEATHER_API_KEY');
                if ($apiKey) {
                    $response = Http::timeout(3)->get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric");
                    if ($response->successful()) {
                        $data = $response->json();
                        return [
                            'temp' => round($data['main']['temp']),
                            'condition' => $data['weather'][0]['main'],
                            'icon' => $data['weather'][0]['icon'],
                            'city' => $data['name']
                        ];
                    }
                }
            } catch (\Exception $e) {}

            // Fallback (Simulated)
            return [
                'temp' => 28,
                'condition' => 'Haze',
                'icon' => '50d',
                'city' => $city
            ];
        });
    }

    /**
     * Get Market Top Gainers (Alpha Vantage) + Yahoo Indices
     */
    public function getMarketData()
    {
        return Cache::remember('live_market_data_v2', 300, function () {
            // 1. Get Indices from Yahoo (Reliable)
            $indices = $this->getYahooIndices();
            
            // 2. Try to get Top Gainers from Alpha Vantage
            $movers = $this->getAlphaVantageMovers();

            return array_merge($indices, $movers);
        });
    }

    protected function getYahooIndices()
    {
        try {
            $symbols = '^NSEI,^BSESN,INR=X,GC=F';
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0'
            ])->timeout(4)->get("https://query1.finance.yahoo.com/v7/finance/quote?symbols={$symbols}");

            if ($response->successful() && isset($response['quoteResponse']['result'])) {
                return $this->formatMarketData($response['quoteResponse']['result']);
            }
        } catch (\Exception $e) {}
        
        return $this->getSimulatedMarketData(); // Fallback
    }

    protected function getAlphaVantageMovers()
    {
        try {
            $apiKey = env('ALPHA_VANTAGE_KEY');
            if ($apiKey) {
                // Using TOP_GAINERS_LOSERS endpoint
                $response = Http::timeout(4)->get("https://www.alphavantage.co/query?function=TOP_GAINERS_LOSERS&apikey={$apiKey}");
                
                if ($response->successful() && isset($response['top_gainers'])) {
                    $data = array_slice($response['top_gainers'], 0, 3); // Take top 3 gainers
                    return array_map(function($item) {
                        return [
                            'symbol' => $item['ticker'],
                            'name' => $item['ticker'], // AV doesn't give full name in this endpoint easily
                            'price' => $item['price'],
                            'change' => $item['change_percentage'],
                            'up' => true,
                            'chart_color' => 'text-green-500',
                            'note' => 'Top Gainer'
                        ];
                    }, $data);
                }
            }
        } catch (\Exception $e) {}

        return [];
    }

    public function getCricketMatches()
    {
        return Cache::remember('live_cricket_matches', 60, function () {
            try {
                $apiKey = env('CRICKET_API_KEY');
                if ($apiKey) {
                    $response = Http::timeout(3)->get('https://api.cricapi.com/v1/currentMatches', [
                        'apikey' => $apiKey,
                        'offset' => 0,
                    ]);

                    if ($response->successful() && isset($response['data'])) {
                        return $this->formatCricketData($response['data']);
                    }
                }
            } catch (\Exception $e) {}

            return $this->getSimulatedCricketMatches();
        });
    }

    // --- Helpers (Same as before, simplified) ---

    protected function formatMarketData($results)
    {
        $mapped = [];
        $mapConfig = [
            '^NSEI' => ['symbol' => 'NIFTY', 'name' => 'NIFTY 50'],
            '^BSESN' => ['symbol' => 'SENSEX', 'name' => 'SENSEX'],
            'INR=X' => ['symbol' => 'USD/INR', 'name' => 'US Dollar'],
            'GC=F' => ['symbol' => 'GOLD', 'name' => 'Gold (Comex)'],
        ];

        foreach ($results as $item) {
            $s = $item['symbol'];
            if (!isset($mapConfig[$s])) continue;
            $meta = $mapConfig[$s];
            $change = $item['regularMarketChangePercent'] ?? 0;
            $mapped[] = [
                'symbol' => $meta['symbol'],
                'name' => $meta['name'],
                'price' => number_format($item['regularMarketPrice'] ?? 0, 2),
                'change' => ($change > 0 ? '+' : '') . number_format($change, 2) . '%',
                'up' => $change >= 0,
                'chart_color' => $change >= 0 ? 'text-green-600' : 'text-accent-red',
            ];
        }
        return $mapped;
    }

    protected function formatCricketData($apiData)
    {
        $matches = [];
        $count = 0;
        foreach ($apiData as $match) {
            if ($count >= 4) break;
            if (!isset($match['name']) || !isset($match['status'])) continue;
            $teams = $match['teamInfo'] ?? [];
            
            // Score parsing logic (simplified)
            $t1Score = ''; $t2Score = '';
             if (isset($match['score'])) {
                foreach($match['score'] as $sc) {
                    if (str_contains($sc['inning'], $teams[0]['shortname'] ?? 'Tx')) $t1Score = $sc['r'] . '/' . $sc['w'];
                    if (str_contains($sc['inning'], $teams[1]['shortname'] ?? 'Ty')) $t2Score = $sc['r'] . '/' . $sc['w'];
                }
            }

            $matches[] = [
                'id' => $match['id'],
                'league' => $match['matchType'] ?? 'LIVE',
                'team1' => $teams[0]['shortname'] ?? 'T1',
                'team1_flag' => $teams[0]['img'] ?? '',
                'team1_score' => $t1Score,
                'team2' => $teams[1]['shortname'] ?? 'T2',
                'team2_flag' => $teams[1]['img'] ?? '',
                'team2_score' => $t2Score,
                'status_label' => Str::upper($match['status']),
                'status_color' => 'bg-accent-red',
                'note' => $match['status'],
                'live' => true,
            ];
            $count++;
        }
        return $matches;
    }

    protected function getSimulatedCricketMatches()
    {
        // ... (Same simulation as before) ...
        $seconds = now()->timestamp;
        $runVar = ($seconds % 10); 
        return [
            [
                'id' => 1, 'league' => 'ICC Test', 'team1' => 'AUS', 'team1_flag' => '🇦🇺', 'team1_score' => '518/7', 
                'team2' => 'ENG', 'team2_flag' => '🇬🇧', 'team2_score' => '384', 'status_label' => 'STUMPS', 'status_color' => 'bg-green-600', 'note' => 'AUS lead by 134 runs', 'live' => true
            ],
            [
                'id' => 2, 'league' => 'T20', 'team1' => 'IND', 'team1_flag' => '🇮🇳', 'team1_score' => '198/3', 
                'team2' => 'SA', 'team2_flag' => '🇿🇦', 'team2_score' => '142/5', 'status_label' => 'LIVE', 'status_color' => 'bg-red-600', 'note' => 'SA need 57 runs', 'live' => true
            ]
        ];
    }

    protected function getSimulatedMarketData()
    {
        // ... (Same simulation as before) ...
        return [
            ['symbol' => 'NIFTY', 'name' => 'NIFTY 50', 'price' => '26,180.10', 'change' => '-0.27%', 'up' => false, 'chart_color' => 'text-red-400'],
            ['symbol' => 'SENSEX', 'name' => 'SENSEX', 'price' => '85,064.62', 'change' => '-0.44%', 'up' => false, 'chart_color' => 'text-red-400'],
            ['symbol' => 'USD/INR', 'name' => 'USD/INR', 'price' => '90.15', 'change' => '-0.06%', 'up' => false, 'chart_color' => 'text-red-400'],
        ];
    }
}
