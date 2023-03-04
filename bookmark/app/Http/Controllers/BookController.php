<?php

namespace App\Http\Controllers;

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
        return view('books/show', [
            'title' => $title
        ]);
    }

    public function filter($category, $subcategory) {
        return $category . ', ' . $subcategory;
    }

}