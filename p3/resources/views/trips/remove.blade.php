{{-- /resources/views/books/create.blade.php --}}
@extends('layouts/main')

@section('title')
    Remove from Your List
@endsection

@section('content')
    <h1>Remove</h1>
    <h2>{{ $place->place }}</h2>
    <br>
    <p>Are you sure you want to remove <em>{{ $place->place }}</em> from My Trip?</p>

    <form method='POST' action='/mytrip/{{ $place->slug }}'>

        {{ method_field('delete') }}

        {{ csrf_field() }}

        <button type='submit' class='btn btn-primary'>Yes, I want to remove {{ $place->place }}</button>
        <br>
        <br>
        <a href='/mytrip'>No, I changed my mind.</a>
    </form>
@endsection
