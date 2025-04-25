
    <div class="card text-dark">
        <div class="d-flex justify-content-between">
            <p class="px-2 py-1" style="margin: 0">WEATHER MAP</p>
                <select id="layerSelect">
                    <option value="temp_new">Temperature</option>
                    <option value="clouds_new">Clouds</option>
                    <option value="precipitation_new">Precipitation</option>
                    <option value="wind_new">Wind</option>
                    <option value="pressure_new">Pressure</option>
                </select>
        </div>

        <div id="map" >
        </div>
    </div>


@push('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        $(document).ready(function () {
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
            }).addTo(map);

            const layerSelect = document.getElementById('layerSelect');

            layerSelect.addEventListener('change', function () {
                map.removeLayer(weatherLayer);
                const selectedLayer = this.value;

                weatherLayer = L.tileLayer(`https://tile.openweathermap.org/map/${selectedLayer}/{z}/{x}/{y}.png?appid=${apiKey}`, {
                    opacity: 1
                }).addTo(map);
            });

        });
    </script>
@endpush
