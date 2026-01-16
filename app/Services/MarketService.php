<?php

namespace App\Services;

class MarketService
{
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function fetchStockPrice($symbol)
    {
        // Example with Alpha Vantage
        $url = 'https://www.alphavantage.co/query';
        $params = [
            'function' => 'GLOBAL_QUOTE',
            'symbol' => $symbol,
            'apikey' => env('ALPHA_VANTAGE_KEY')
        ];

        $response = $this->apiClient->request('GET', $url, $params, 'AlphaVantage');

        if ($response['success'] && isset($response['data']['Global Quote'])) {
            $quote = $response['data']['Global Quote'];
            return [
                'symbol' => $quote['01. symbol'],
                'price' => $quote['05. price'],
                'change' => $quote['09. change'],
                'change_percent' => trim($quote['10. change percent'], '%'),
                'volume' => $quote['06. volume'],
                'last_updated' => now()
            ];
        }

        return null;
    }
}
