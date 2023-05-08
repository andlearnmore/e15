@extends('layouts/main')

@section('title')
    {{ $place->place }}
@endsection

@section('head')
@endsection

@section('content')
    <h1>{{ $city->city }}: {{ $place->place }}</h1>
    @if ($place->address)
        <p>{{ $place->address }}</p>
    @endif
    @if ($place->metro)
        <p><b>Metro: </b>{{ $place->metro }}</p>
    @endif
    @if ($place->open)
        <p><b>Hours: </b>{{ $place->open }} - {{ $place->closed }}</p>
    @endif
    @if ($place->visit_length)
        <p>Plan to spend this many hours here: {{ $place->visit_length }}</p>
    @endif
    @if ($place->fee == 1)
        <p>There is a fee to visit {{ $place->place }}</p>
    @endif
    @if ($place->reservation_reqd == 1)
        <p>A reservation is required.</p>
    @endif
    <div>
        <a href='{{ $place->url }}' class='btn btn-light' target='_blank'>Learn more</a>
    </div>


    <div>
        <a href='/{{ $country }}/{{ $city->slug }}' class='btn btn-light test='nav-back'>Back to
            {{ ucfirst($city->city) }}</a>
    </div>
    <div>
        <form method='POST' action='/mytrip/{slug}/save'>
            {{ csrf_field() }}
            <input type='hidden' id='slug' name='slug' value='{{ $place->slug }}''>
            <button class='btn btn-primary' test='add-button'>Save to My Trip</button>
        </form>
    </div>
@endsection
