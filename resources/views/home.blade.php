@extends('layouts.master')
@section('content')
<main>
    <div class="home-top d-flex justify-content-center">
        <div class="row">
            @include('city-search')

        </div>
    </div>
    <div class="home-bottom bg-dark d-flex justify-content-center">
        <div class="col col-lg-4 col-md-6 col-sm-12">
        @include('weather-map')
        </div>
    </div>
</main>
@endsection
