<div class="d-flex align-items-center justify-content-center">
    <form action="{{route('weather-search')}}" method="post" id="city-form">
        @csrf
            <select class="" name="city" id="city-dropdown" style="width: 400px; border-radius: 23px !important">

            </select>
{{--            <button type="submit" class="btn btn-sm btn-success m-0">--}}
{{--                Search--}}
{{--            </button>--}}

    </form>
</div>

@push('scripts')
<script>
    $(document).ready(function (){
        $('#city-dropdown').select2({
            placeholder: 'Select a city',
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
            minimumInputLength: 2,
        });
    });
    $('#city-dropdown').on('select2:select', function (e) {
        document.getElementById('city-form').submit();
    });
</script>
@endpush
