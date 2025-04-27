@extends('layouts.master')
@section('content')

<!-- Main Content -->
<main class="container" style="min-height: 88vh">

    <div class="p-5">
        @include('city-search')
    </div>
    <!-- Current Weather -->
    <section class="row mb-3">
        @if($weather_data)
        <div class="card text-dark col col-6 my-5">
                <div class="card-body">
                    <h2 class="card-text h6 ">{{ strtoupper($weather_data['city'] . ' ,' . $weather_data['sys']['country']) }}</h2>
                    <h2 class="card-title fw-bold">{{ round($weather_data['main']['temp']) }}°C</h2>
                    <p class="card-text ">Feels like {{ round($weather_data['main']['feels_like']) }}°C. {{$weather_data['weather'][0]['description']}}</p>
                    <p class="card-text ">{{ getWindCategory($weather_data['wind']['speed']) }}</p>
                    <p class="card-text fw-bold"> AQI
                        {{ session('aqi')['data']['current']['pollution']['aqius'] ?? 'N/A' }}
                    </p>
                    <ul class="list-unstyled ">
                        <li>Wind: {{$weather_data['wind']['speed']}} {{ wind_direction($weather_data['wind']['deg']) }}</li>
                        <li>Pressure: {{$weather_data['main']['pressure']}} hPa</li>
                        <li>Humidity: {{$weather_data['main']['humidity']}}%</li>
                        <li>Visibility: {{ Number::abbreviate($weather_data['visibility']) }}m</li>
                    </ul>
                </div>
        </div>
        @endif
        <div class="col col-6 align-content-center">
            @include('weather-map')
        </div>
    </section>

</main>
@endsection




