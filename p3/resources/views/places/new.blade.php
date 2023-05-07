@extends('layouts/main')

@section('title')
    {{ $place->place }}
@endsection

@section('head')
@endsection

@section('content')
    <p>You added something!</p>
    <h1> {{ $place->place }}</h1>
    @if ($place->address)
        <p>{{ $place->address }}</p>
    @endif
    @if ($place->metro)
        <p><b>Metro: </b>{{ $place->metro }}</p>
    @endif
    @if ($place->open)
        <p>{{ $place->open }} - {{ $place->closed }}</p>
    @endif

    <div>
        <form method='POST' action='/mytrip/{slug}/save'>
            {{ csrf_field() }}
            <input type='hidden' id='slug' name='slug' value='{{ $place->slug }}''>
            <button class='btn btn-primary'>Add</button>
        </form>
    </div>
@endsection
