@extends('layouts/main')

@section('title')
    Cities to visit in {{ $country->country }}
@endsection

@section('head')
@endsection

@section('content')
    <p>Show all of the places in a city.</p>

    <h2>{{ $city->city }}, {{ $country->country }}</h2>
    @foreach ($places as $place)
        <a class="location" href='/{{ $country->code }}/{{ $city->slug }}/{{ $place->slug }}'>
            <h4> {{ $place->place }}</h4>
        </a>
    @endforeach
    <a href='/cities'>Back to all cities.</a>
@endsection
