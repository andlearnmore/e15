{{-- /resources/views/books/create.blade.php --}}
@extends('layouts/main')

@section('title')
    Edit a book
@endsection

@section('content')
    <h1>Edit</h1>
    <h2>{{ $book->title }}</h2>

    <form method='POST' action='/books/{{ $book->slug }}'>
        <div class='details'>* Required fields</div>

        {{ method_field('put') }}

        {{ csrf_field() }}

        <label for='slug'>* Short URL</label>
        <input type='text' name='slug' id='slug' value='{{ old('slug', $book->slug) }}'>
        <div class='details'>
            This is a unique URL identifier for the book containing only alphanumeric characters and dashes.
            <br>It’s suggested that the slug be based on the book title, e.g. a good slug for the book <em>“War and
                Peace”</em> would be <em>“war-and-peace”</em>.
        </div>
        @include('includes/error-field', ['fieldName' => 'slug'])

        <label for='title'>* Title</label>
        <input type='text' name='title' id='title' value='{{ old('title', $book->title) }}'>
        @include('includes/error-field', ['fieldName' => 'title'])

        <label for='author_id'>* Author</label>
        <select name='author_id'>
            <option value=''>Choose one...</option>
            @foreach ($authors as $author)
                <option value='{{ $author->id }}'
                    {{ (old('author_id') == $author->id or isset($book->author->id) and $book->author->id == $author->id) ? 'selected' : '' }}
                    {{ $author->first_name . ' ' . $author->last_name }}</option>
            @endforeach
        </select>
        @include('includes.error-field', ['fieldName' => 'author_id'])

        <label for='published_year'>* Published Year (YYYY)</label>
        <input type='text' name='published_year' id='published_year'
            value='{{ old('published_year', $book->published_year) }}'>
        @include('includes/error-field', ['fieldName' => 'published_year'])


        <label for='cover_url'>Cover URL</label>
        <input type='text' name='cover_url' id='cover_url' value='{{ old('cover_url', $book->cover_url) }}'>
        @include('includes/error-field', ['fieldName' => 'cover_url'])


        <label for='info_url'>* Wikipedia URL</label>
        <input type='text' name='info_url' id='info_url' value='{{ old('info_url', $book->info_url) }}'>
        @include('includes/error-field', ['fieldName' => 'info_url'])

        <label for='purchase_url'>* Purchase URL </label>
        <input type='text' name='purchase_url' id='purchase_url' value='{{ old('purchase_url', $book->purchase_url) }}'>
        @include('includes/error-field', ['fieldName' => 'purchase_url'])

        <label for='description'>Description</label>
        <textarea name='description'>{{ old('description', $book->description) }}</textarea>
        @include('includes/error-field', ['fieldName' => 'description'])


        <button type='submit' class='btn btn-primary'>Add Book</button>

        {{-- @if (count($errors) > 0)
            <ul class='alert alert-danger'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif --}}

    </form>
@endsection
