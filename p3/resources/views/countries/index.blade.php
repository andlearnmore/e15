@extends('layouts/main')

@section('title')
    Countries
@endsection

@section('head')
@endsection

@section('content')
    {{-- @if (!$countries->code)
        <p>That country is not included in this app.</p>
        <div> <a href='/countries'>Here is the list of countries available.</a></div>
    @else --}}
    @foreach ($countries as $country)
        <a href='/{{ $country->code }}/cities'>
            <h3> {{ $country->country }}</h3>
        </a>
    @endforeach
    {{-- @endif --}}
@endsection
