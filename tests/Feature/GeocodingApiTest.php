<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Tests\TestCase;

class GeocodingApiTest extends TestCase
{
    /** @test */
    public function city_names_should_return_valid_geocoding_response()
    {
        $apiKey = env('OPENWEATHERMAP_API_KEY');
        $cities = json_decode(Storage::disk('local')->get('city.list.json'), true);

        // Limit number of cities to avoid hitting API rate limits
        $testCities = array_slice($cities, 0, 100); // test first 50 cities

        $failedCities = [];

        foreach ($testCities as $city) {
            $cityName = $city['name'];
            $response = Http::get("http://api.openweathermap.org/geo/1.0/direct", [
                'q' => $cityName,
                'limit' => 1,
                'appid' => $apiKey,
            ]);

            if (!$response->ok()) {
                $failedCities[] = "{$cityName} - HTTP Error";
                continue;
            }

            $data = $response->json();

            if (empty($data) || !isset($data[0]['lat']) || !isset($data[0]['lon'])) {
                $failedCities[] = "{$cityName} - Invalid data structure";
                continue;
            }

            // Optional: show successful city
            echo "✓ {$cityName} passed.\n";
        }

        if (!empty($failedCities)) {
            Log::channel('stack')->error("Geocoding API failed for cities:", $failedCities);
            $this->fail("Some cities failed validation. See logs.");
        }

        $this->assertTrue(true); // If no failures, mark test as passed
    }
}
