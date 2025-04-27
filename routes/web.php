<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CityController;
use App\Http\Controllers\WeatherController;



Route::get('/', [HomeController::class, 'index'])->name('home');


//route for ajax
Route::get('/city-search', [CityController::class, 'searchCities'])->name('city-search');

//routes for weather
Route::post('/weather-search', [WeatherController::class, 'getWeather'])->name('weather-search');
Route::get('/weather', [HomeController::class, 'weather'])->name('weather');
