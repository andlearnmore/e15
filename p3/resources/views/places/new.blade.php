@extends('layouts/main')

@section('title')
    {{ $place->place }}
@endsection

@section('head')
@endsection

@section('content')
    <div>
        <p class='flash-alert'>{{ $place->place }} added!</p>
    </div>
    <h2>{{ $place->place }}</h2>
    @include('layouts/details')
    <br>
    <div>
        <a href='/mytrip/{{ $place->slug }}/edit' class='btn btn-primary'>
            Edit</a>
    </div>
    <br>
    @include('layouts/backtomytrips')
@endsection
