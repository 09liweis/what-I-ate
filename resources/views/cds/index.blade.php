@extends ('layouts.app')

@section('title')
CDS List
@endsection

@section('content')

<h1>CDS List</h1>
<a class="btn btn-primary" href="{{ url('/cds/create')}}">Add CD</a>
@foreach ($cds as $cd)
<p><a href="{{ url('/cds', $cd->id) }}">{{$cd->titel}}</a> <a class="btn btn-warning" href="cds/{{ $cd->id }}/edit">Edit</a></p>
@endforeach

@endsection