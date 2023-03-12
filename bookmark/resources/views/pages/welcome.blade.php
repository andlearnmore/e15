@extends('layouts/main')

@section('title')
    Welcome
@endsection

@section('content')
    <p>Welcome to Bookmark, an online book journal that lets you track and share a history of books you've read.</p>


    <form method='GET' action='/search'>

        <h2>Search for a book to add to your list</h2>

        <fieldset>
            <label for='searchTerms'>
                Search terms:
                <input type='text' name='searchTerms'>
            </label>
        </fieldset>

        <fieldset>
            <label>
                Search type:
            </label>

            <input type='radio' name='searchType' id='title' value='title' checked>
            <label for='title'> Title</label>

            <input type='radio' name='searchType' id='author' value='author'>
            <label for='author'> Author</label>

        </fieldset>

        <button type='submit' class='btn btn-primary'>Search</button>

    </form>
@endsection
