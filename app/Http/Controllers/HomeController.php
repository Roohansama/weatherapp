<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        if(session()->has('weather_data')){
            $weather_data = session('weather_data');

            // 🧠 Now you can process $weatherData
            // e.g. transform, log, enrich, etc.

            return view('home', compact('weather_data'));
        }

        return view('home');
    }
}
