@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Foods</h1>
    @foreach ($foods as $food)
    <div class="row food shadow-kit">
        <div class="col-xs-4 food-img-container">
            <img class="img-responsive food-img" src="{{ $food->photo_url }}" />
        </div>
        <div class="col-md-8 food-content">
            <h3><a href="/food/{{$food->id}}">{{ $food->name }}</a></h3>
            <p><i class="fa fa-star"></i> {{ $food->rating }}</p>
            <p class="food-price">$ {{ $food->price }}</p>
            <p><i class="fa fa-calendar"></i> {{ $food->created_at }}</p>
            <p><a href="/location/{{$food->location->id}}"><i class="fa fa-map-marker"></i> {{ $food->location->address }}</a></p>
        </div>
    </div>
    @endforeach
    
</div>
@endsection
