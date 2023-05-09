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
    </h2>{{ $place->place }}</h2>
    <div>
        @include('layouts/details')
    </div>
    <div>
        <a href='/mytrip/{{ $place->slug }}/edit' class='btn btn-primary'>
            Edit</a>
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
