@extends('layouts/main')

@section('title')
    Cities in {{ $country->country }}
@endsection

@section('head')
@endsection

@section('content')
    <p>List the cities in {{ $country->country }}.</p>
    <h2>{{ $country->country }}</h2>
    <div id="cities">
        @foreach ($cities as $city)
            <a class="city" href='/{{ $country->code }}/{{ $city->slug }}/places'>
                <h4> {{ $city->city }}</h4>
            </a>
        @endforeach
    </div>
    <a href='/countries'>Back to countries list</a>
@endsection
