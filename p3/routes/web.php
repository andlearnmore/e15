<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
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
Route::get('contact', [PageController::class, 'contact']);
Route::any('/practice/{n?}', [PracticeController::class, 'index']);

Route::get('/countries', [CountryController::class, 'index']);
Route::get('/countries/{code}', [CountryController::class, 'show']);

Route::get('/cities/{code}', [CityController::class, 'show']);

// Route::get('/{slug}/places', [PlaceController::class, 'index']);


// Route::get('/cities/create', [CityController::class, 'create']);