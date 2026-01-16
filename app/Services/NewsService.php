<?php

namespace App\Services;

use Carbon\Carbon;

class NewsService
{
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    /**
     * Fetch news from multiple sources and standardize.
     */
    public function fetchNews($category = 'general')
    {
        // For now, we simulate calling one source or loop through available ones
        // Ideally we check active sources from DB
        
        $results = [];

        // Example: GNews
        // $gnews = $this->fetchGNews($category);
        // $results = array_merge($results, $gnews);

        // Example: NewsAPI
        $newsParams = [
            'country' => 'in',
            'category' => $category,
            'apiKey' => env('NEWS_API_KEY')
        ];
        
        // This is just a stub logic to show structure. 
        // Real implementation would look like:
        /*
        $response = $this->apiClient->request('GET', 'https://newsapi.org/v2/top-headlines', $newsParams, 'NewsAPI');
        if ($response['success']) {
            $formatted = $this->formatNewsAPI($response['data']);
            $results = array_merge($results, $formatted);
        }
        */

        return $results;
    }

    public function fetchGNews($query = 'top-news')
    {
        $url = 'https://gnews.io/api/v4/top-headlines';
        $params = [
            'token' => env('GNEWS_API_KEY'),
            'lang' => 'en',
            'q' => $query
        ];

        $response = $this->apiClient->request('GET', $url, $params, 'GNews');
        
        if (!$response['success']) {
            return [];
        }

        return $this->formatGNews($response['data']);
    }

    protected function formatGNews($data)
    {
        $articles = $data['articles'] ?? [];
        $formatted = [];

        foreach ($articles as $article) {
            $formatted[] = [
                'source_name' => 'GNews',
                'author' => $article['source']['name'] ?? 'Unknown',
                'title' => $article['title'],
                'description' => $article['description'],
                'url' => $article['url'],
                'image_url' => $article['image'],
                'published_at' => Carbon::parse($article['publishedAt']),
                'content' => $article['content']
            ];
        }
        return $formatted;
    }
    
    // Add formatNewsAPI, formatMediaStack similar to above
}
