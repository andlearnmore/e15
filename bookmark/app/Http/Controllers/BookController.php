<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index() {
    # In the future, we could query a database for all the books
    # But for now we'll just return this hypothetical placeholder
    return 'Here are all the books...';
    }

    public function show($title) {
        return 'Results for the book: '.$title;
    }

    public function filter($category, $subcategory) {
        return $category . ', ' . $subcategory;
    }

}