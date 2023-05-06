@extends('layouts/main')

@section('title')
    Show a Place {{-- Placeholder text: will be name of place --}}
@endsection

@section('head')
@endsection

@section('content')
    <p>Show details of the place selected (from the DB).</p>
    <h1>{{ ucFirst($city->city) }}: {{ $place->place }}</h1>
    <p>{{ $place->address }}</p>
    <p><b>Metro: </b>{{ $place->metro }}</p>
    <p>{{ $place->open }} - {{ $place->closed }}</p>



    <a href='/{{ $country }}/{{ $city->slug }}/places'>Back to {{ ucfirst($city->city) }}</a>
@endsection
