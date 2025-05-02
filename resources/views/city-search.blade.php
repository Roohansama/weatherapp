<div class="d-flex align-items-center justify-content-center">
    <form action="{{route('weather-search')}}" method="post" id="city-form">
        @csrf
        <select name="city" id="city-dropdown" style="width: 300px; border-radius: 23px">
            @if(old('city'))
                <option value="{{ old('city') }}" selected>{{ old('city') }}</option>
            @endif
        </select>
       </form>
</div>

@push('scripts')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
        $(document).ready(function () {

        $('#city-dropdown').select2({
        placeholder: 'Select a city',
        ajax: {
        url: "{{ route('city-search') }}",
        dataType: 'json',
        delay: 250,
        data: function (params) {
        return { q: params.term };
    },
        processResults: function (data) {
        return { results: data.results };
    },
        cache: true
    },
        minimumInputLength: 2,
    });

        // Auto-submit on select
        $('#city-dropdown').on('select2:select', function (e) {
        document.getElementById('city-form').submit();
    });
    });

</script>
@endpush
