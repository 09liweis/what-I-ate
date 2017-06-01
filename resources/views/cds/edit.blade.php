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
<form method="post", action="{{ url('/cds', $cd->id) }}">
    {{ method_field('PUT') }}
    {{ csrf_field() }}
    <div class="form-group">
        <label>Title</label>
        <input class="form-control" name="titel" value="{{ $cd->titel }}" />
    </div>
    <div class="form-group">
        <label>Interpret</label>
        <input class="form-control" name="interpret" value="{{ $cd->interpret }}" />
    </div>
    <div class="form-group">
        <label>Jahr</label>
        <input class="form-control" name="jahr" value="{{ $cd->jahr }}" />
    </div>
    <input type="submit" class="btn btn-success" value="Update" />
</form>

@endsection