<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItineraryController;
use App\Http\Controllers\PageController;

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

Route::get('/itinerary', [ItineraryController::class, 'index']);
Route::get('/itinerary/show', [ItineraryController::class, 'show']);