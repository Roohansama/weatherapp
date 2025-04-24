<div class="d-flex align-items-center">
    <form action="{{route('weather-search')}}" method="post">
        @csrf
            <select name="city" id="city-dropdown" style="width: 300px; border-radius: 23px">

            </select>
            <button type="submit" class="btn btn-sm btn-success m-0">
                Search
            </button>

    </form>
</div>

@section('scripts')
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
