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

# Filter route used to demonstrate working with multiple route parameters
Route::get('/books/filter/{category}/{subcategory}', [BookController::class, 'filter']);

/**
 * Books
 */

Route::get('/books', [BookController::class, 'index']);

# Make sure the create route comes before the `/books/{slug}` route so it takes precedence
Route::get('/books/create', [BookController::class, 'create']);

Route::post('/books', [BookController::class, 'store']);

# Show the form to edit a specific book
Route::get('/books/{slug}/edit', [BookController::class, 'edit']);

# Process the form to edit a specific book
Route::put('/books/{slug}', [BookController::class, 'update']);

# Show a page to delete a specific book
Route::get('/books/{slug}/delete', [BookController::class, 'delete']);

# Process the deletion
Route::delete('/books/{slug}', [BookController::class, 'destroy']);

Route::get('/books/{slug}', [BookController::class, 'show']);

Route::get('/search', [BookController::class, 'search']);

/**
 * Lists
 */

Route::get('/list', [ListController::class, 'show']);

 /**
  * Practice
  */
Route::get('/example', function() {
    $foo = [1,2,3];
    Log::info($foo);
    return view('abc');
});