<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\WeatherController;

class HomeController extends Controller
{
    public function index(Request $request){
        $weather = new WeatherController();
        $weather->getWeather();
        if(session()->has('weather_data')){
            $weather_data = session('weather_data');

            // 🧠 Now you can process $weatherData
            // e.g. transform, log, enrich, etc.

            return view('home', compact('weather_data'));
        }

        return view('home');
    }
}
