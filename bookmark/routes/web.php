<?php

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\PracticeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', [PageController::class, 'welcome']);
Route::get('/contact', [PageController::class, 'contact']);
Route::any('/practice/{n?}', [PracticeController::class, 'index']);
Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']); # Filter route used to demonstrate working with multiple route parameters

Route::group(['middleware' => 'auth'], function() {
    /**
     * Books
     */

    Route::get('/books', [BookController::class, 'index']);
    Route::get('/books/create', [BookController::class, 'create']); # Make sure the create route comes before the `/books/{slug}` route so it takes precedence
    Route::post('/books', [BookController::class, 'store']);

    # Edit
    Route::get('/books/{slug}/edit', [BookController::class, 'edit']); # Show the form to edit a specific book
    Route::put('/books/{slug}', [BookController::class, 'update']); # Process the form to edit a specific book

    # Delete
    Route::get('/books/{slug}/delete', [BookController::class, 'delete']); # Show a page to delete a specific book
    Route::delete('/books/{slug}', [BookController::class, 'destroy']); # Process the deletion

    Route::get('/books/{slug}', [BookController::class, 'show']);
    Route::get('/search', [BookController::class, 'search']);

    /**
     * Lists
     */

    Route::get('/list', [ListController::class, 'show']);
    Route::get('/list/{slug}/add', [ListController::class, 'add']);
    Route::post('/list/{slug}/save', [ListController::class, 'save']);

    # Edit
    Route::put('/list', [ListController::class, 'update']);

    # Remove
    Route::get('/list/{slug}/delete', [ListController::class, 'delete']); # Show a page to delete a specific book
    Route::delete('/list/{slug}', [ListController::class, 'destroy']); # Process the deletion



});

/**
  * Practice
  */
Route::get('/example', function() {
    $foo = [1,2,3];
    Log::info($foo);
    return view('abc');
});