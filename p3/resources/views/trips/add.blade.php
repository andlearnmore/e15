@extends('layouts/main')

@section('title')
    Add {{ $place->place }} to My Trip
@endsection

@section('content')
    <h1>Add to My Trip</h1>
    <h2>{{ $place->place }}</h2>

    <form method='POST' action='/mytrip/{{ $place->slug }}/save'>
        <div class='details'>* Required fields</div>
        {{ csrf_field() }}

        <button class='btn btn-primary'>Add</button>
    </form>
@endsection
