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

    {{-- <div><a href='/{{ $country }}/{{ $city->slug }}'>Back to {{ ucfirst($city->city) }}</a></div> --}}
    <div><a href='/places/create'>Add to my list</a></div>
@endsection
