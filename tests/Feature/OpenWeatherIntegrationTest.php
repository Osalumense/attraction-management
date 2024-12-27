<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Cache;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Attractions;
use App\Models\User;
use Illuminate\Support\Facades\Http;
use App\Services\WeatherService;

class OpenWeatherIntegrationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function test_authenticated_users_can_see_weather_details_for_an_attraction()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        Http::fake([
            'api.openweathermap.org/*' => Http::response([
                'weather' => [
                    ['description' => 'clear sky']
                ],
                'main' => [
                    'temp' => 300.15,  // Example temperature in Kelvin
                    'humidity' => 80,  // Example humidity percentage
                ],
            ], 200),
        ]);

        $attraction = Attractions::factory()->create(['location' => 'London']);

        $response = $this->get(route('attractions.show', $attraction->id));
        $response->assertStatus(200)->assertSee('clear sky');
    }

    public function test_it_caches_weather_data_for_one_hour()
    {
        $location = 'Belarus';
        $weatherDataFirstCall = app(WeatherService::class)->getWeather($location);

        // Call the method again within 1 hour, the cache should be used
        $weatherDataSecondCall = app(WeatherService::class)->getWeather($location);

        
        // Assert that the cache was used and the API was not called
        $weatherDataFirstCallDescription = $weatherDataFirstCall['weather'][0]['description'];
        $weatherDataSecondCallDescription = $weatherDataSecondCall['weather'][0]['description'];
        
        $weatherDataFirstCallTemp = $weatherDataFirstCall['main']['temp'];
        $weatherDataSecondCallTemp = $weatherDataSecondCall['main']['temp'];

        $this->assertEquals($weatherDataFirstCallDescription, $weatherDataSecondCallDescription);
        $this->assertEquals($weatherDataFirstCallTemp, $weatherDataSecondCallTemp);

        // Ensure the weather data is cached
        $cacheKey = 'weather_' . strtolower(str_replace(' ', '_', $location));
        $cachedWeatherData = Cache::get($cacheKey);

        $this->assertNotNull($cachedWeatherData); // Ensure that data is cached
        $this->assertEquals($weatherDataSecondCallDescription, $cachedWeatherData['weather'][0]['description']);
    }
}
