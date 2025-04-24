@extends('layouts.master')
@section('content')
<main>
    <div class="home-top d-flex justify-content-center">
        <div class="row">
            @include('city-search')

        </div>
    </div>
    <div class="home-bottom bg-dark d-flex justify-content-center">
        @include('weather-map')
    </div>
</main>
@endsection
