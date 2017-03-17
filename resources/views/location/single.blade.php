@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">{{$location->name}}</h1>

    <div class="row food">
        <div class="col-xs-4">
            <div class="shadow-kit">
                <img class="img-responsive food-img" src="{{ $location->photo_url }}" />
                <div class="padding">

                </div>
            </div>
        </div>
        <div class="col-xs-8">
            <div class="shadow-kit">
                <div id="location-map">
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var lat = {{ $location->lat }};
    var lng = {{ $location->lng }};
</script>
@endsection
