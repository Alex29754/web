<?php

require_once __DIR__ . '/ApiClient.php';

class OpenWeatherMap
{
    private ApiClient $client;
    private string $apiKey;

    public function __construct(string $apiKey)
    {
        $this->client = new ApiClient('https://api.openweathermap.org/data/2.5');
        $this->apiKey = $apiKey;
    }

    public function getCurrentWeather(string $city): array
    {
        return $this->client->get('/weather', [
            'q' => $city,
            'appid' => $this->apiKey,
            'units' => 'metric',
            'lang' => 'ru'
        ]);
    }
}
