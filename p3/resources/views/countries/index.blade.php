@extends('layouts/main')

@section('title')
    Countries
@endsection

@section('head')
@endsection

@section('content')
    @foreach ($countries as $country)
        <a href='/cities/{{ $country->code }}'>
            <h3> {{ $country->country }}</h3>
        </a>
    @endforeach
@endsection
