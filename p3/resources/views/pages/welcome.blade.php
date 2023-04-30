@extends('layouts/main')

@section('title')
    EuroPlan
@endsection

@section('head')
    <link href='/css/europlan/.css' rel='stylesheet'>
@endsection

@section('content')
    @if (Auth::user())
        <h2>
            Hello {{ Auth::user()->name }}!
        </h2>
    @endif
@endsection
