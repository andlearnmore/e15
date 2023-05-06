@extends('layouts/main')

@section('title')
    Places to See in {{ $city->city }}
@endsection

@section('head')
@endsection

@section('content')
    <p>Details about a city? Or the planner form?</p>
    <p>Here I'll list cards for all of the places in the country/city selected.</p>
    <h2>{{ $city->city }}, {{ $country->country }}</h2>
    <div id=places>
        @foreach ($places as $place)
            <a class="location" href='/{{ $country->code }}/{{ $city->slug }}/{{ $place->slug }}'>
                <h4> {{ $place->place }}</h4>
            </a>
        @endforeach
    </div>
    <a href='/{{ $country->code }}/cities'>Back to {{ ucfirst($country->country) }}</a>
@endsection
