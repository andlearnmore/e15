@extends('layouts/main')

@section('title')
    EuroPlan
@endsection

@section('head')
    <link href='/css/europlan/.css' rel='stylesheet'>
@endsection

@section('content')
    @if (Auth::user())
        <h2>
            Hello {{ Auth::user()->name }}!
        </h2>
    @endif
    <h4>{{ $welcomeMessage }}</h4>
    <p>
        EuroPlan is your place to explore cities in a number of European countries.
        Log in to:
    </p>
    <ul>
        <li>Get full access to All Cities</li>
        <li>See things to do in each city.</li>
        <li>Add places to your My Trip: a wishlist of places you'd like to visit.</li>
        <li>Don't see a place that you know you want to visit? You can add it! Don't worry: you are the only person who will
            be able to see the places you add.</li>
        <li>You may not have all of the details about a place when you add it. Not a problem: you can always come back and
            edit details for places you add.</li>


    </ul>
    <p>If you're here as a visitor, we suggest you start by checking out Berlin! (It's the place with the most real data.)
    </p>
@endsection
