@extends('layouts/main')

@section('title')
    Show a Place {{-- Placeholder text: will be name of place --}}
@endsection

@section('head')
@endsection

@section('content')
    <p>Show details of the place selected (from the DB).</p>
    <h1>{{ $place->place }}</h1>
    <p>{{ $place->address }}</p>

    <a href='/{{ $country }}/{{ $city }}/places'>Back to {{ ucfirst($city) }}</a>
@endsection
