@extends('layouts/main')

@section('title')
    {{ $place->place }}
@endsection

@section('head')
@endsection

@section('content')
    <p>Show details of the place selected (from the DB).</p>
    <h1>{{ ucFirst($city->city) }}: {{ $place->place }}</h1>
    <p>{{ $place->address }}</p>
    <p><b>Metro: </b>{{ $place->metro }}</p>
    <p>{{ $place->open }} - {{ $place->closed }}</p>

    <div><a href='/{{ $country }}/{{ $city->slug }}'>Back to {{ ucfirst($city->city) }}</a></div>
    <div><a href='/places/create'>Add to my list</a></div>
@endsection
