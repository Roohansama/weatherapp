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

            $aqi = $this->getAirPollutionData($geocode);

            $response = Http::get('https://api.openweathermap.org/data/2.5/weather', [
                'lat' => $geocode['latitude'],
                'lon' => $geocode['longitude'],
                'units' => 'metric',
                'appid' => env('OPENWEATHERMAP_API_KEY')
            ]);

            $weather_data = $response->json();

            $weather_data['city'] = $this->city;

            if (!empty($weather_data)) {
                return redirect()->to('/weather')->with([
                    'weather_data' => $weather_data,
                    'aqi' => $aqi,
                ]);
            }

            return response()->json(['error' => 'City not found'], 404);

        }catch (\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back();
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
            toastr()->error($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    }

    public function getAirPollutionData($geocode){
        try{
          return $response = Http::get('http://api.airvisual.com/v2/nearest_city',[
                'lat' => $geocode['latitude'],
                'lon' => $geocode['longitude'],
                'key' => env('IQAIR_API_KEY')
            ])->json();

        }catch (\Exception $e){
            toastr()->error($e->getMessage());
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
