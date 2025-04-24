<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\WeatherController;

class HomeController extends Controller
{
    public function weather(){
        if(session()->has('weather_data')){

            $weather_data = session('weather_data');

            return view('weather', compact('weather_data'));
        }

        return view('weather');
    }

    public function index(){
        return view('home');
    }

}
