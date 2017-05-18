@extends ('layouts.app')

@section('title')
CD Details
@endsection

@section('content')

<h1>{{ $cd->titel }}</h1>
<div>{{ $cd->interpret }}</div>
<div>Jahr: {{ $cd->jahr }}</div>

@endsection