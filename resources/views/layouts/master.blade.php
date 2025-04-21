<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{asset('css/home.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
{{--            background: {{asset('../images/field-yellow-flowers-with-hills-cloudy-sky.jpg')}};--}}
/*            background-size: cover;*/
            /*color: white;*/
        }
        /*.forecast-card {*/
        /*    background-color: rgba(44, 44, 46, 0.8);*/
        /*    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);*/
        /*}*/
        /*.table th, .table td {*/
        /*    color: white;*/
        /*}*/
        /*header {*/
        /*    background: rgba(0, 0, 0, 0.8);*/
        /*    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);*/
        /*}*/
        /*footer {*/
        /*    background: rgba(0, 0, 0, 0.8);*/
        /*}*/
    </style>
</head>
<body>

@include('layouts.header')
@yield('content')
{{--@include('layouts.footer')--}}

</body>
</html>
