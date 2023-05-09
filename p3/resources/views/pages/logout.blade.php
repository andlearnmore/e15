@extends('layouts/main')

@section('title')
    Logout
@endsection

@section('head')
@endsection

@section('content')
    <form method='POST' id='logout' action='/logout'>
        {{ csrf_field() }}
        <button class='button-link' test='logout-button' type='submit'>
            Logout
        </button>
    </form>

    <form method='POST' id='logout' action='/logout'>
        {{ csrf_field() }}
        <button class='button-link' test='logout-button' type='submit'>
            Logout
        </button>
    </form>
@endsection
