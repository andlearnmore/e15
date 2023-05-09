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
    <div>
        </h2>{{ $place->place }}</h2>
    </div>
    <div>
        @include('layouts/details')
    </div>
    <div>
        <form method='GET' action='/mytrip/{slug}/edit'>
            {{ csrf_field() }}
            <input type='hidden' id='slug' name='slug' value='{{ $place->slug }}''>
            <button class='btn btn-primary'>Edit {{ $place->place }}</button>
        </form>
    </div>
    @include('layouts/backtomytrips')
    {{-- <div>
        <form method='POST' action='/mytrip/{slug}/save'>
            {{ csrf_field() }}
            <input type='hidden' id='slug' name='slug' value='{{ $place->slug }}''>
            <button class='btn btn-primary'>Add</button>
        </form>
    </div> --}}
@endsection
