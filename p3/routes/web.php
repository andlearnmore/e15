<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CityController;

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

// I'll consider going up to the country level after I get cities working.
// Route::get('/countries', [PageController::class, 'countries']);

Route::get('/cities', [CityController::class, 'index']);

Route::get('/cities/create', [CityController::class, 'create']);