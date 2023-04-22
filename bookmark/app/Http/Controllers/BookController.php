<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Book;


class BookController extends Controller
{
    /**
     * GET /books
     */
    public function index() 
    {
        $books = Book::orderBy('title', 'ASC')->get();
        
        //$newBooks = Book::orderBy('id', 'DESC')->limit(3)->get();
        $newBooks = $books->sortByDesc('id')->take(3);

    return view('books/index', [
        'books' => $books, 
        'newBooks' => $newBooks
    ]);
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
    * GET /books/{slug}/edit
    * Display page to edit book
    */
    public function edit(Request $request, $slug)
    {
        $book = Book::where('slug', '=', $slug)->first();

        if (!$book) {
            return redirect('/books')->with(['flash-alert' => 'Book not found.']);
        }

        return view('books/edit', ['book' => $book]);
    }

    /**
     * PUT /books/{slug}
     */
    public function update(Request $request, $slug) 
    {
        $book = Book::where('slug', '=', $slug)->first();

        $request->validate([
            'slug' => 'required|unique:books,slug,' . $book->id . '|alpha_dash',
            'title' => 'required',
            'author' => 'required',
            'published_year' => 'required|digits:4',
            'cover_url' => 'url',
            'info_url' => 'url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:100'
        ]);

        $book->slug = $request->slug;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();

        return redirect('/books/'.$slug.'/edit')->with(['flash-alert' => 'Your changes were saved.']);


    }

    /**
     * GET /books/{slug}/delete
     */
    public function delete(Request $request, $slug)
    {
        // $book = Book::where('slug', '=', $slug)->first();
        $book = Book::findBySlug($slug);

        if (!$book) {
            return redirect('/books')->with([
                'flash-alert' => 'Book not found.'
            ]);
        }
        
        return view('books/delete', ['book' => $book]);
    }

    /**
     * DELETE /books/{slug}
     */
     public function destroy(Request $request, $slug)
     {
        // $book = Book::where('slug', '=', $slug)->first();
        $book = Book::findBySlug($slug);
        $book->delete();

        return redirect('/books')->with([
            'flash-alert' => $book->title . 'has been deleted.'
        ]);
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
            'title' => 'required|max:255',
            'slug' => 'required|unique:books,slug', #name of table,name of field that should be unique
            'author' => 'required|max:255',
            'published_year' => 'required|digits:4',
            'cover_url' => 'url',
            'info_url' => 'required|url',
            'purchase_url' => 'required|url',
            'description' => 'required|min:100'
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->slug = $request->slug;
        $book->author = $request->author;
        $book->published_year = $request->published_year;
        $book->cover_url = $request->cover_url;
        $book->info_url = $request->info_url;
        $book->purchase_url = $request->purchase_url;
        $book->description = $request->description;
        $book->save();
    
        return redirect('/books/create')->with(['flash-alert' => 'Your book has been added.']);
        #with() flashes data to the session as part of the redirect.
        # Note: If validation fails, it will automatically redirect the visitor back to the form page
        # and none of the code that follows will execute.
    
    }
        /**
        * GET /search
        * Search books based on title or author.
        */

    public function search(Request $request)
    {
        $request->validate([
            'searchTerms' => 'required',
            'searchType' => 'required'
        ]);

        # If validation fails it will redirect back to `/`

        $searchType = $request->input('searchType', 'title');
        $searchTerms = $request->input('searchTerms', '');

        $books = Book::orderBy('title', 'ASC')->get()->toArray();
        $searchResults = Book::where($searchType, 'LIKE', '%'.$searchTerms.'%')->get();

        foreach ($books as $slug => $book) {
            if (strtolower($book[$searchType]) == strtolower($searchTerms)) {
                $searchResults[$slug] = $book;
            }
        }

        # Redirect back to the form with data/results stored in the session
        # Ref: https://laravel.com/docs/responses#redirecting-with-flashed-session-data
        return redirect('/')->with([
            'searchResults' => $searchResults
        ])->withInput();
    }  

    /**
        * GET /books/{slug}
    */
    public function show($slug)
    {
        # This build method for the Log facade is something I added as part of HW6.
        Log::build([
            'driver' => 'slack', 
            'path' => storage_path('logs/books.log'),
            'url' => 'https://hooks.slack.com/services/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',
            'username' => 'Book Search Log',
            'emoji' => ':book:',
        ])->info('The user looked at the book ' .$slug .' on ' .date('d-M-Y'));

        $book = Book::where('slug', '=', $slug)->first();

        return view('books/show', [
            'book' => $book
        ]);
    }

    public function filter($category, $subcategory) 
    {
        return $category . ', ' . $subcategory;
    }
}