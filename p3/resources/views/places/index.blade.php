@extends('layouts/main')

@section('title')
    {{ $place->place }}
@endsection

@section('head')
@endsection

@section('content')
    <h1>{{ $city->city }}: {{ $place->place }}</h1>

    @if (!$onList)
        <div>
            <form method='POST' action='/mytrip/{slug}/add'>
                {{ csrf_field() }}
                <input type='hidden' id='slug' name='slug' value='{{ $place->slug }}'>
                <button class='btn btn-primary' test='add-button'>Save to My Trip</button>
            </form>
        </div>
    @endif
    @include('layouts/details')
    <br>
    <div>
        <a href='/{{ $country }}/{{ $city->slug }}' class='btn btn-light test='nav-back'>Back to
            {{ ucfirst($city->city) }}</a>
    </div>
@endsection
