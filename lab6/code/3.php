<?php

require_once __DIR__ . '/index.php';

$apiKey = 'твой_api_ключ_сюда';  // Вставь сюда свой API-ключ

$owm = new OpenWeatherMap($apiKey);

try {
    $weather = $owm->getCurrentWeather('Moscow');
    echo "Погода в Москве:\n";
    echo "Температура: " . $weather['main']['temp'] . "°C\n";
    echo "Описание: " . $weather['weather'][0]['description'] . "\n";
} catch (Exception $e) {
    echo "Ошибка: " . $e->getMessage();
}
