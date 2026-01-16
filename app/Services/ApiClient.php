<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Models\ApiLog;
use Exception;

class ApiClient
{
    /**
     * Send an HTTP request and handle logging/errors.
     *
     * @param string $method GET, POST, etc.
     * @param string $url Full URL
     * @param array $params Query params or Body
     * @param string $serviceName Name of service for logging (e.g. 'NewsAPI')
     * @param array $headers Optional headers
     * @param int $timeout Timeout in seconds
     * @return array Standardized response ['success' => bool, 'data' => mixed, 'error' => string]
     */
    public function request(string $method, string $url, array $params = [], string $serviceName = 'General', array $headers = [], int $timeout = 10): array
    {
        $start = microtime(true);
        $status = null;
        $error = null;
        $responseBody = null;

        try {
            $client = Http::withHeaders($headers)
                ->timeout($timeout)
                ->retry(2, 100); // Retry twice with 100ms sleep

            if (strtolower($method) === 'get') {
                $response = $client->get($url, $params);
            } else {
                $response = $client->$method($url, $params);
            }

            $status = $response->status();
            $responseBody = $response->body();
            
            if ($response->successful()) {
                $this->log($serviceName, $url, $params, $status, null, microtime(true) - $start);
                return [
                    'success' => true,
                    'data' => $response->json(),
                    'error' => null
                ];
            } else {
                $error = 'Request failed with status ' . $status . ': ' . $responseBody;
                $this->log($serviceName, $url, $params, $status, $error, microtime(true) - $start);
                return [
                    'success' => false,
                    'data' => null,
                    'error' => $error
                ];
            }

        } catch (Exception $e) {
            $error = $e->getMessage();
            $this->log($serviceName, $url, $params, 500, $error, microtime(true) - $start);
            return [
                'success' => false,
                'data' => null,
                'error' => $error
            ];
        }
    }

    protected function log($service, $url, $payload, $statusCode, $errorMessage, $duration)
    {
        try {
            ApiLog::create([
                'service' => $service,
                'endpoint' => $url,
                'payload' => json_encode($payload),
                'status_code' => $statusCode,
                'error_message' => substr($errorMessage, 0, 1000), // Truncate if too long
                'duration_ms' => round($duration * 1000),
            ]);
        } catch (Exception $e) {
            // Do not fail main request if logging fails
        }
    }
}
