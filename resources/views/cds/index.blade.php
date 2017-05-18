@extends ('layouts.app')

@section('title')
CDS List
@endsection

@section('content')

<h1>CDS List</h1>
@foreach ($cds as $cd)
<p><a href="{{ url('/cds', $cd->id) }}">{{$cd->titel}}</a></p>
@endforeach

@endsection