<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{

    public $city;
    public function getWeather(Request $request){
        try{
            $geocode = $this->getGeoCoordinates($request->city);


            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'lat' => $geocode['latitude'],
                'lon' => $geocode['longitude'],
                'units' => 'metric',
                'appid' => env('OPENWEATHERMAP_API_KEY')
            ]);


            $weather_data = $response->json();

            $weather_data['city'] = $this->city;


            if (!empty($weather_data)) {
                return redirect()->to('/')->with('weather_data', $weather_data);
            }

            return response()->json(['error' => 'City not found'], 404);

        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
    public  function getGeoCoordinates($city)
    {
        try{
          $seperatedArray = explode('-', $city);
          $this->city = $seperatedArray[0];
          $country = $seperatedArray[1];

          $query = $this->city.','.$country;
            $response = Http::get('http://api.openweathermap.org/geo/1.0/direct', [
                'q' => $query,
                'limit' => 5,
                'appid' => env('OPENWEATHERMAP_API_KEY')
            ]);

            $data = $response->json();

//            dd($data);


            if (!empty($data)) {
                $lat = $data[0]['lat'];
                $lon = $data[0]['lon'];

                return [
                    'latitude' => $lat,
                    'longitude' => $lon
                ];
            }

            return response()->json(['error' => 'City not found'], 404);

        }catch (\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }
}
