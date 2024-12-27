<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class WeatherService
{
    /**
     * Fetch current weather for a given location.
     *
     * @param string $location
     * @return array|null
     */
    public function getWeather(string $location)
    {
        $cacheKey = 'weather_' . strtolower(str_replace(' ', '_', $location));

        // Cache for 1 hour
        $weatherData = Cache::remember($cacheKey, 3600, function () use ($location) {
            $response = Http::get("http://api.openweathermap.org/data/2.5/weather", [
                'q' => $location,
                'appid' => env('OPENWEATHER_API_KEY'),
                'units' => 'metric',
            ]);

            if ($response->successful()) {
                return $response->json();
            }

            return null;
        });

        return $weatherData;
    }
}