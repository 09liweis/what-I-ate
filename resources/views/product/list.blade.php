@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">Product</h1>
    <a class="btn btn-primary" href="{{ url('products/create') }}">Add Product</a>
    @foreach ($products as $product)
    <div class="row food shadow-kit">
        <h2>{{ $product->name }}</h2>
        <p>{{ $product->description }}</p>
        <p>{{ $product->price }}</p>
    </div>
    @endforeach
    
</div>
@endsection
