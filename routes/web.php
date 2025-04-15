<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\WeatherController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/dd', [CityController::class, 'dd']);

Route::get('/', function(){
    return view('home');
});

//route for ajax
Route::get('/city-search', [CityController::class, 'searchCities'])->name('city-search');

//routes for weather
Route::post('/weather-search', [WeatherController::class, 'getWeather'])->name('weather-search');
