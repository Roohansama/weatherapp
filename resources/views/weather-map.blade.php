<div class="col-4">
    <div class="card text-dark">
        <p class="bg-light d-flex justify-content-start px-2 py-1">WEATHER MAP</p>

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

    </div>
</div>
@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        @php
            $coordinates = session('aqi')['data']['location']['coordinates'] ?? [73.0479, 33.6844];
            if (!empty(session('aqi')['data']['location']['coordinates'])){
               $zoom = 8;
            }else{
                $zoom = 1;
            }
        @endphp
        const apiKey = "{{ env('OPENWEATHERMAP_API_KEY') }}";
        const lat = {{ $coordinates[1] ?? 'N/A' }};
        const lon = {{ $coordinates[0] ?? 'N/A' }};
        const zoom = {{ $zoom }};

        const map = L.map('map').setView([lat, lon], zoom); // Default to Islamabad

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
