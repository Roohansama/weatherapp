<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #1c1c1e;
            color: white;
        }
        .forecast-card {
            background-color: #2c2c2e;
        }
        .table th, .table td {
            color: white;
        }
    </style>
</head>
<body>
<!-- Header -->
<header class="bg-dark text-white p-3 d-flex justify-content-between align-items-center">
    <h1 class="h4 mb-0">WeatherNow</h1>

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

    <small>Apr 12, 11:55am</small>
</header>

<!-- Main Content -->
<main class="container my-5">
    <!-- Current Weather -->
    <section class="row mb-5">
        <div class="col-lg-6 mb-4">
            <h2 class="h5">London, GB</h2>
            <div class="display-3 fw-bold">18°C</div>
            <p>Feels like 17°C. Broken clouds. Gentle Breeze</p>
            <ul class="list-unstyled text-muted">
                <li>Wind: 4.0m/s SE</li>
                <li>Pressure: 1007hPa</li>
                <li>Humidity: 54%</li>
                <li>UV: 4</li>
                <li>Dew point: 9°C</li>
                <li>Visibility: 10.0km</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <img src="" alt="Map" class="img-fluid rounded shadow">
            <div class="bg-secondary bg-opacity-75 text-white p-2 mt-2 rounded">
                <p class="mb-0">No precipitation within an hour</p>
            </div>
        </div>
    </section>

    <!-- Hourly Forecast -->
    <section class="mb-5">
        <h3 class="h6 mb-3">Hourly forecast</h3>
        <div class="table-responsive">
            <table class="table table-borderless text-center align-middle">
                <thead class="text-muted">
                <tr>
                    <th>Time</th>
                    <th>11am</th><th>12pm</th><th>1pm</th><th>2pm</th><th>3pm</th><th>4pm</th><th>5pm</th><th>6pm</th><th>7pm</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Temp</td>
                    <td colspan="9">
                        <div class="d-flex justify-content-between align-items-end" style="height: 100px;">
                            <div class="bg-danger w-100 mx-1" style="height: 65%;"></div>
                            <div class="bg-danger w-100 mx-1" style="height: 65%;"></div>
                            <div class="bg-danger w-100 mx-1" style="height: 65%;"></div>
                            <div class="bg-danger w-100 mx-1" style="height: 75%;"></div>
                            <div class="bg-danger w-100 mx-1" style="height: 75%;"></div>
                            <div class="bg-danger w-100 mx-1" style="height: 70%;"></div>
                            <div class="bg-danger w-100 mx-1" style="height: 65%;"></div>
                            <div class="bg-danger w-100 mx-1" style="height: 60%;"></div>
                            <div class="bg-danger w-100 mx-1" style="height: 55%;"></div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>Clouds</td>
                    <td colspan="9">Broken to Overcast Clouds</td>
                </tr>
                <tr>
                    <td>Wind</td>
                    <td>3.7m/s</td><td>4.0m/s</td><td>4.3m/s</td><td>4.7m/s</td><td>4.5m/s</td><td>4.3m/s</td><td>3.8m/s</td><td>3.1m/s</td><td>2.1m/s</td>
                </tr>
                </tbody>
            </table>
        </div>
    </section>

    <!-- 8-day Forecast -->
    <section>
        <h3 class="h6 mb-3">8-day forecast</h3>
        <div class="row g-3">
            <div class="col-md-6 col-lg-3">
                <div class="forecast-card p-3 rounded d-flex justify-content-between align-items-center">
                    <div>
                        <p class="fw-bold mb-1">Sat, Apr 12</p>
                        <small class="text-muted">broken clouds</small>
                    </div>
                    <div>
                        <span class="h5 mb-0">19 / 5°C</span>
                    </div>
                </div>
            </div>
            <!-- Add more forecast cards similarly -->
        </div>
    </section>
</main>

<!-- Footer -->
<footer class="bg-dark text-center py-3 text-muted">
    &copy; 2025 WeatherNow. All rights reserved.
</footer>

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
</body>
</html>
