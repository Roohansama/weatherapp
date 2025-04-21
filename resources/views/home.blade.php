@extends('layouts.master')
@section('content')

<!-- Main Content -->
<main class="container my-5">

    <div class="d-flex">
        <form action="{{route('weather-search')}}" method="post">
            @csrf
            <label for="city-dropdown" class="mx-3">Select a city</label>
            <select name="city" id="city-dropdown" style="width: 300px;">

            </select>
            <button type="submit" class="btn btn-small btn-success">
                Search
            </button>
        </form>
    </div>
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
        <div class="col-lg-6">
{{--            <div class="card bg-dark text-white">--}}
{{--                <img src="" alt="Map" class="card-img-top img-fluid rounded shadow">--}}
{{--                <div class="card-body">--}}
{{--                    <p class="card-text">No precipitation within an hour</p>--}}
{{--                </div>--}}
{{--            </div>--}}
        </div>
    </section>

</main>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function (){
        $('#city-dropdown').select2({
            placeholder: 'Type to search for a city...',
            ajax: {
                url: "{{route('city-search')}}",
                dataType: 'json',
                delay: 250,
                data: function (params){
                    return { q: params.term };
                },
                processResults: function (data){
                    return{ results: data.results };
                },

                cache: false
            },
            minimumInputLength: 2
        });
    });
</script>

@endsection

