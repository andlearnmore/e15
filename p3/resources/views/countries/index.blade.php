@extends('layouts/main')

@section('title')
    Countries
@endsection

@section('head')
@endsection

@section('content')
    @foreach ($countries as $country)
        <a href='/countries/{{ $country->code }}'>
            <h3> {{ $country->name }}</h3>
        </a>
    @endforeach
@endsection
