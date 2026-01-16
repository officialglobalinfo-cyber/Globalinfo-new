<?php

namespace App\Services;

class CricketService
{
    protected $apiClient;

    public function __construct(ApiClient $apiClient)
    {
        $this->apiClient = $apiClient;
    }

    public function fetchLiveMatches()
    {
        // Example placeholder for CricketData API
        $url = 'https://api.cricketdata.org/v1/matches';
        $params = [
            'apikey' => env('CRICKET_API_KEY'),
            'offset' => 0
        ];

        $response = $this->apiClient->request('GET', $url, $params, 'CricketData');
        
        // Return standardized array...
        return $response['success'] ? $response['data'] : [];
    }
}
