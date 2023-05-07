@extends('layouts/main')

@section('title')
    {{ $place->place }}
@endsection

@section('head')
@endsection

@section('content')
    <p>Show details of the place selected (from the DB).</p>
    <h1>{{ ucFirst($city->city) }}: {{ $place->place }}</h1>
    @if ($place->address)
        <p>{{ $place->address }}</p>
    @endif
    @if ($place->metro)
        <p><b>Metro: </b>{{ $place->metro }}</p>
    @endif
    @if ($place->open)
        <p>{{ $place->open }} - {{ $place->closed }}</p>
    @endif

    <div><a href='/{{ $country }}/{{ $city->slug }}'>Back to {{ ucfirst($city->city) }}</a></div>
    <div>
        <form method='POST' action='/mytrip/{slug}/save'>
            {{ csrf_field() }}
            <input type='hidden' id='slug' name='slug' value='{{ $place->slug }}''>
            <button class='btn btn-primary'>Add</button>
        </form>
    </div>
@endsection
