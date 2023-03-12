<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
* GET /search
* Search books based on title or author.
*/
public function search(Request $request) {
    {
        # ======== Temporary code to explore $request ==========

        # Get all the properties and methods available in the $request object
        // dump($request); # Object of type Illuminate\Http\Request

        # Get the form data (array) from the $request object
        // dump($request->all()); # Equivalent of dump($_GET)

        # Get the form data from individual fields
        // dump($request->input('searchTerms'));
        // dump($request->input('searchType'));
    
        # Form data from individual fields can also be accessed via dynamic properties
        // dump($request->searchTerms);

        # Boolean to see if the request contains data for a particular field
        // dump($request->has('searchTerms'));
        
        # You can get more information about a request than just the data of the form, for example...
        // dump($request->path()); # "search"
        // dump($request->is('search')); # true
        //dump($request->is('books')); # false
        //dump($request->fullUrl()); # e.g. http://bookmark.loc search?searchTerms=Harry%20Potter&searchType=title
        //dump($request->method()); # GET
        //dump($request->isMethod('post')); # False

        # ======== End exploration of $request ==========
}
    return 'Process the search form...';
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