<?php

class ApiClient
{
    private string $baseUrl;
    private array $headers;
    private string $logFile;

    public function __construct(string $baseUrl, ?string $authToken = null)
    {
        $this->baseUrl = rtrim($baseUrl, '/');
        $this->headers = ['Content-Type: application/json'];
        $this->logFile = __DIR__ . '/apiclient.log';

        if ($authToken) {
            $this->headers[] = "Authorization: Bearer $authToken";
        }
    }

    private function request(string $method, string $endpoint, array $data = []): array
    {
        $url = $this->baseUrl . $endpoint;
        $ch = curl_init();

        if ($method === 'GET' && !empty($data)) {
            $url .= '?' . http_build_query($data);
        } elseif (in_array($method, ['POST', 'PUT', 'DELETE'])) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        }

        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => $this->headers,
            CURLOPT_CUSTOMREQUEST => $method,
        ]);

        $response = curl_exec($ch);
        $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        $this->log($method, $url, $data, $response, $status);

        if (curl_errno($ch)) {
            throw new Exception('Ошибка cURL: ' . curl_error($ch));
        }

        curl_close($ch);

        if ($status >= 400) {
            throw new Exception("HTTP ошибка: $status\nОтвет: $response");
        }

        return json_decode($response, true);
    }

    public function get(string $endpoint, array $params = []): array
    {
        return $this->request('GET', $endpoint, $params);
    }

    public function post(string $endpoint, array $data): array
    {
        return $this->request('POST', $endpoint, $data);
    }

    public function put(string $endpoint, array $data): array
    {
        return $this->request('PUT', $endpoint, $data);
    }

    public function delete(string $endpoint, array $data = []): array
    {
        return $this->request('DELETE', $endpoint, $data);
    }

    private function log(string $method, string $url, array $data, $response, int $status): void
    {
        $log = sprintf(
            "[%s] %s %s\nData: %s\nStatus: %d\nResponse: %s\n\n",
            date('Y-m-d H:i:s'),
            $method,
            $url,
            json_encode($data),
            $status,
            $response
        );
        file_put_contents($this->logFile, $log, FILE_APPEND);
    }
}
