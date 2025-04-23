<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\WeatherController;

class HomeController extends Controller
{
    public function index(){
        if(session()->has('weather_data')){

            $weather_data = session('weather_data');

            return view('home', compact('weather_data'));
        }

        return view('home');
    }

    public function renderMap(){
        return view('layouts.map');
    }
}
