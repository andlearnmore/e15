@extends('layouts/main')

@section('title')
    Index
@endsection

@section('head')
    {{--
Page specific CSS includes should be defined here; 
this .css file does not exist yet, but we can create it 
--}}
    <link href='/css/books/show.css' rel='stylesheet'>
@endsection

@section('content')
    <h1>Index</h1>

    <p>
        Here are all of the books
    </p>
@endsection
