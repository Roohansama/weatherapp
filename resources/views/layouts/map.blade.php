@extends('layouts.master')
@section('content')
    <h2>Interactive Weather Map</h2>

    <div class="layer-toggle">
        <select id="layerSelect">
            <option value="temp_new">Temperature</option>
            <option value="clouds_new">Clouds</option>
            <option value="precipitation_new">Precipitation</option>
            <option value="wind_new">Wind</option>
            <option value="pressure_new">Pressure</option>
        </select>
    </div>

    <div id="map"></div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        const apiKey = "{{ env('OPENWEATHERMAP_API_KEY') }}";
        const map = L.map('map').setView([33.6844, 73.0479], 8); // Default to Islamabad

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19
        }).addTo(map);

        let weatherLayer = L.tileLayer(`https://tile.openweathermap.org/map/temp_new/{z}/{x}/{y}.png?appid=${apiKey}`, {
            opacity: 1
        }).addTo(map);

        const layerSelect = document.getElementById('layerSelect');

        layerSelect.addEventListener('change', function () {
            map.removeLayer(weatherLayer);
            const selectedLayer = this.value;

            weatherLayer = L.tileLayer(`https://tile.openweathermap.org/map/${selectedLayer}/{z}/{x}/{y}.png?appid=${apiKey}`, {
                opacity: 1
            }).addTo(map);
        });
    </script>
@endsection
