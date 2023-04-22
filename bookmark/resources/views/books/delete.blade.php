{{-- /resources/views/books/create.blade.php --}}
@extends('layouts/main')

@section('title')
    Delete
@endsection

@section('content')
    <h1>Delete</h1>
    <h2>{{ $book->title }}</h2>
    <br>
    <p>Are you sure you want to delete <em>{{ $book->title }}</em>?</p>

    <form method='POST' action='/books/{{ $book->slug }}'>

        {{ method_field('delete') }}

        {{ csrf_field() }}

        <button type='submit' class='btn btn-primary'>Yes, I want to delete this book</button>
        <br>
        <br>
        <a href='/books'>No, I changed my mind.</a>
    </form>
@endsection
