@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Locations</h1>
    @foreach ($locations as $location)
    <div class="row food shadow-kit">
        <div class="col-xs-4 food-img-container">
            <img class="img-responsive food-img" src="{{ $location->photo_url }}" />
        </div>
        <div class="col-md-8 food-content">
            <h3><a href="/location/{{$location->id}}">{{ $location->name }}</a></h3>
            <p><i class="fa fa-marker"></i> {{ $location->address }}</p>
        </div>
    </div>
    @endforeach
    
</div>
@endsection
