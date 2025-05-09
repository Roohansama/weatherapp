<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link href="{{asset('css/home.css')}}" rel="stylesheet">

    <style>
        @if(request()->is('/'))
            body{
            background-image: url("{{asset('/images/cropped-mountain-range-sunset-landscape-cloudy-sky-mountain-peaks-3840x2160-4620(1).jpg')}}");
        }
        @elseif(request()->is('weather'))
            body{
            background-color: #f0f4f8; /* Soft bluish-white */
            /*background-color: #f8fbff; !* Very light icy blue *!*/
            /*background-color: #e6f0ff; !* Cooler, wintry tone *!*/
            /*background-color: #edf2f7; !* Subtle gray/blue undertone *!*/
        }
        @endif
    </style>
</head>
<body>

    @include('layouts.header')

        @yield('content')

    @include('layouts.footer')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
@stack('scripts')

</body>
</html>
