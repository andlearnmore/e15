@extends('layouts/main')

@section('title')
    Bookmark
@endsection

@section('head')
    <link href='/css/welcome/.css' rel='stylesheet'>
@endsection

@section('content')

    @if (Auth::user())
        <h2>
            Hello {{ Auth::user()->name }}!
        </h2>
    @endif

    <p>Welcome to Bookmark, an online book journal that lets you track and share a history of books you've read.</p>


    <form test='search-form' method='GET' action='/search'>

        <h2>Search for a book to add to your list</h2>

        <fieldset>
            <label for='searchTerms'>
                Search terms:
                <input test='searchTerms' type='text' name='searchTerms' value='{{ old('searchTerms') }}'>
            </label>
        </fieldset>

        <fieldset>
            <label>
                Search type:
            </label>

            <input test='search-type-title' type='radio' name='searchType' id='title' value='title'
                {{ old('searchType') == 'title' ? 'checked' : '' }}>
            <label for='title'> Title</label>

            <input test='search-type-author' type='radio' name='searchType' id='author' value='author'
                {{ old('searchType') == 'author' ? 'checked' : '' }}>
            <label for='author'> Author</label>

        </fieldset>

        <button type='submit' class='btn btn-primary'>Search</button>

        @if (count($errors) > 0)
            <ul class='alert alert-danger'>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </form>

    @if (!is_null($searchResults))
        @if (count($searchResults) == 0)
            <div class='results alert alert-warning'>
                No results found.
            </div>
        @else
            <div class='results alert alert-primary'>

                {{ count($searchResults) }}
                {{ Str::plural('Result', count($searchResults)) }}:

                <ul test='search-results-list' class='clean-list'>
                    @foreach ($searchResults as $book)
                        {{-- <li><a href='/books/{{ $book->slug }}'> {{ $book->title }}</a></li> --}}
                        <li> {{ $book['title'] }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    @endif
@endsection
