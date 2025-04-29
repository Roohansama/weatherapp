@extends('layouts.master')
@section('content')

<!-- Main Content -->
<main class="container" style="min-height: 88vh">

    <div class="p-5">
        @include('city-search')
    </div>
    <!-- Current Weather -->
    <section class="row mb-3">
        @if(isset($weather_data))
        <div class="card text-dark col col-6 my-5">
            <div class="row justify-content-between ">
                <h6 class="m-0 p-2 " style="width: fit-content;">Current Weather</h6>
                <h6 class="m-0 p-2  fw-bold" style="width: fit-content;">1:00pm</h6>
                <hr class="">
            </div>
            <div class="row h-100">
                <div class="col align-content-center">
                    <h2 class="h6">{{ strtoupper($weather_data['city'] . ' ,' . $weather_data['sys']['country']) }}</h2>
                    <h2 class=" fw-bold">{{ round($weather_data['main']['temp']) }}°C</h2>
                    <p class=" ">Feels like {{ round($weather_data['main']['feels_like']) }}°C. {{$weather_data['weather'][0]['description']}}</p>
                    <p class=" ">{{ getWindCategory($weather_data['wind']['speed']) }}</p>
                </div>
                <div class="col align-content-center">
                    <p class=" fw-bold"> AQI
                        {{ session('aqi')['data']['current']['pollution']['aqius'] ?? 'N/A' }}
                    </p>
                    <ul class="list-unstyled">
                        <li class="row justify-content-between">
                            <p style="width: fit-content; margin: 0">
                                Wind:
                            </p
                            ><p class="fw-bold" style="width: fit-content; margin: 0">
                                {{$weather_data['wind']['speed']}} {{ wind_direction($weather_data['wind']['deg']) }}
                            </p>
                        </li>
                        <hr>
                        <li class="row justify-content-between">
                            <p style="width: fit-content; margin: 0">
                                Pressure:
                            </p>
                            <p class="fw-bold" style="width: fit-content; margin: 0">
                                {{$weather_data['main']['pressure']}} hPa
                            </p>
                        </li>
                        <hr>
                        <li class="row justify-content-between">
                            <p style="width: fit-content; margin: 0">
                                Humidity:
                            </p>
                            <p class="fw-bold" style="width: fit-content; margin: 0">
                                {{$weather_data['main']['humidity']}}%
                            </p>
                        </li>
                        <hr>
                        <li class="row justify-content-between">
                            <p style="width: fit-content; margin: 0">
                                Visibility:
                            </p>
                            <p class="fw-bold" style="width: fit-content; margin: 0">
                                {{ Number::abbreviate($weather_data['visibility']) }}m
                            </p>
                        </li>
                        <hr>
                    </ul>
                </div>
            </div>
        </div>
        @endif
        <div class="col col-6 align-content-center">
            @include('weather-map')
        </div>
    </section>

</main>
@endsection




