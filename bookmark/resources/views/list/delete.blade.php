{{-- /resources/views/books/create.blade.php --}}
@extends('layouts/main')

@section('title')
    Remove from Your List
@endsection

@section('content')
    <h1>Remove</h1>
    <h2>{{ $book->title }}</h2>
    <br>
    <p>Are you sure you want to remove <em>{{ $book->title }}</em> from Your List?</p>

    <form method='POST' action='/list/{{ $book->slug }}'>

        {{ method_field('delete') }}

        {{ csrf_field() }}

        <button type='submit' class='btn btn-primary'>Yes, I want to remove this book</button>
        <br>
        <br>
        <a href='/books/{{ $book->slug }}'>No, I changed my mind.</a>
    </form>
@endsection
