@extends ('layouts.app')

@section('title')
Add CD
@endsection

@section('content')

@if($errors->any())
    @foreach($errors->all() as $error)
        <p class="alert alert-danger">{{ $error }}</p>
    @endforeach
@endif
<form method="POST", action="{{ url('cds') }}">
    {{ csrf_field() }}
    <div class="form-group">
        <label>Title</label>
        <input class="form-control" name="titel" value="{{ Request::old('titel') }}" />
    </div>
    <div class="form-group">
        <label>Interpret</label>
        <input class="form-control" name="interpret" value="{{ Request::old('interpret') }}" />
    </div>
    <div class="form-group">
        <label>Jahr</label>
        <input class="form-control" name="jahr" value="{{ Request::old('jahr') }}" />
    </div>
    <input type="submit" class="btn btn-success" value="submit" />
</form>

@endsection