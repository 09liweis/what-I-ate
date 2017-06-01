@extends ('layouts.app')

@section('title')
Add Product
@endsection

@section('content')

@if($errors->any())
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
    @endforeach
@endif
<form method="POST", action="{{ url('products') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Name</label>
        <input class="form-control" name="name" value="{{ Request::old('name') }}" />
    </div>
    <div class="form-group">
        <label>Description</label>
        <textarea class="form-control" name="description" value="{{ Request::old('description') }}"></textarea>
    </div>
    <div class="form-group">
        <label>Price</label>
        <input class="form-control" name="price" value="{{ Request::old('price') }}" />
    </div>
    <input type="submit" class="btn btn-success" value="Add" />
</form>

@endsection