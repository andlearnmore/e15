<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;


class BookController extends Controller
{
    /**
     * GET /books
     */
    public function index() 
    {
        # Load book data using PHP's file_get_contents
        # We specify the books.json file path usling Laravel's database_path helper
        $bookData = file_get_contents(database_path('books.json'));

        # Convert the string of JSON text loaded from books.json into an 
        # array using PHP's built-in json_decode function
        $books = json_decode($bookData, true);

        # Alphabetize the books by title using Laravel's Arr::sort
        $books = Arr::sort($books, function($value) {
            return $value['title'];
        });
    return view('books/index', ['books' => $books]);
    }

    /**
    * GET /books/create
    * Display the form to add a new book
    */
    public function create(Request $request) 
    {
        return view('books/create');
    }

/**
* POST /books
* Process the form for adding a new book
*/
public function store(Request $request) {

    # Validate the request data
    # The `$request->validate` method takes an array of data 
    # where the keys are form inputs
    # and the values are validation rules to apply to those inputs
    $request->validate([
        'title' => 'required',
        'author' => 'required',
        'published_year' => 'required|digits:4',
        'cover_url' => 'url',
        'purchase_url' => 'required|url',
        'description' => 'required|min:255'
    ]);
 
     # Note: If validation fails, it will automatically redirect the visitor back to the form page
     # and none of the code that follows will execute.
 
     # Code will eventually go here to add the book to the database,
     # but for now we'll just dump the form data to the page for proof of concept
     dump($request->all());
 }
    /**
    * GET /search
    * Search books based on title or author.
    */

    public function search(Request $request)
    {
        # Get the form input values (default to null if no values exist)
        $searchTerms = $request->input('searchTerms', null);
        $searchType = $request->input('searchType', null);
    
        # Load our json book data and convert it to an array
        $bookData = file_get_contents(database_path('books.json'));
        $books = json_decode($bookData, true);
        
        # Do search
        $searchResults = [];
        foreach ($books as $slug => $book) {
            if (strtolower($book[$searchType]) == strtolower($searchTerms)) {
                $searchResults[$slug] = $book;
            }
        }
    
        # Redirect back to the form with data/results stored in the session
        # Ref: https://laravel.com/docs/responses#redirecting-with-flashed-session-data
        return redirect('/')->with([
            'searchTerms' => $searchTerms,
            'searchType' => $searchType,
            'searchResults' => $searchResults
        ]);
    }
    
    /**
        * GET /books/{slug}
        */

    public function show($slug)
    {
        # Load book data
        # TODO: This code is redundant with loading the books in the index method

        # This build method for the Log facade is something I added as part of HW6.
        Log::build([
            'driver' => 'slack', 
            'path' => storage_path('logs/books.log'),
            'url' => 'https://hooks.slack.com/services/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',
            'username' => 'Book Search Log',
            'emoji' => ':book:',
                        
        ])->info('The user looked at the book ' .$slug .' on ' .date('d-M-Y'));

        $bookData = file_get_contents(database_path('books.json'));
        $books = json_decode($bookData, true);

        # Narrow down array of books to the single book we're loading
        $book = Arr::first($books, function($value, $key) use($slug) {
            return $key == $slug;
        });

        return view('books/show', [
            'book' => $book
        ]);
    }

    public function filter($category, $subcategory) 
    {
        return $category . ', ' . $subcategory;
    }
}