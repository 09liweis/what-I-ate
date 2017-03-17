@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">{{$food->name}}</h1>

    <div class="row food">
        <div class="col-xs-4">
            <div class="shadow-kit">
                <img class="img-responsive food-img" src="{{ $food->photo_url }}" />
                <div class="padding">
                    <p><i class="fa fa-star"></i> {{ $food->rating }}</p>
                    <p class="food-price">$ {{ $food->price }}</p>
                    <p><i class="fa fa-calendar"></i> {{ $food->created_at }}</p>
                </div>
            </div>
        </div>
        <div class="col-xs-8">
            <div class="shadow-kit">
                <div class="padding">
                    <h3><a href="/location/{{$food->location->id}}">{{$food->location->name}}</a></h3>
                    <p><i class="fa fa-map-marker"></i> {{ $food->location->address }}</p>
                </div>
            </div>
        </div>
    </div>
    
</div>
@endsection
