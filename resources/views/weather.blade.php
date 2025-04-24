@extends('layouts.master')
@section('content')

<!-- Main Content -->
<main class="container">

@include('city-search')
    <!-- Current Weather -->
    <section class="row mb-3">
        <div class="col-6 my-5">
            @if(isset($weather_data))
            <div class="card text-white">
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
        </div>
        @include('weather-map')
    </section>

</main>
@endsection




