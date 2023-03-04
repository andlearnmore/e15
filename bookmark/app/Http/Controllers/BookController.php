<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
    # In the future, we could query a database for all the books
    # But for now we'll just return this hypothetical placeholder
    return view('books/index');
    }

    public function show($title) {

        # TODO: Query the database for the book where title = $title
        Log::build([
            'driver' => 'slack', 
            'path' => storage_path('logs/books.log'),
            'url' => 'https://hooks.slack.com/services/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',
            'username' => 'Book Search Log',
            'emoji' => ':book:',
                        
        ])->info('The user looked at the book ' .$title .' on ' .date('d-M-Y'));

        return view('books/show', [
            'title' => $title
        ]);
    }

    public function filter($category, $subcategory) {
        return $category . ', ' . $subcategory;
    }

}