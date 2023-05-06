<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PlaceController;
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

Route::get('{country}/cities', [CityController::class, 'index']);

Route::get('/{country}/{city}/places', [PlaceController::class, 'index']);

Route::get('/{country}/{city}/{place}', [PlaceController::class, 'show']);

Route::get('/places/create', [PlaceController::class, 'create']);
Route::post('/places', [PlaceController::class, 'store']);


// Route::get('/cities/create', [CityController::class, 'create']);