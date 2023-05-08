<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TripController;


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
if (!App::environment('production')) {
    Route::get('/test/login-as/{userId}', [TestController::class, 'loginAs']);
    Route::get('/test/refresh-database', [TestController::class, 'refreshDatabase']);

    Route::any('/practice/{n?}', [PracticeController::class, 'index']);

}
Route::get('/', [PageController::class, 'welcome']);
Route::get('contact', [PageController::class, 'contact']);

# Dislay all countries with their cities.
Route::get('/cities', [CityController::class, 'index']);

Route::group(['middleware' => 'auth'], function () {
    /**
     * Add places
     */
    # Get here from clicking on "add a place"
    Route::get('/places/create', [PlaceController::class, 'create']);
    Route::post('/places', [PlaceController::class, 'store']);
    // Route::get('/places/new', [PlaceController::class, 'new']);

    /**
     * Trips
     */

    Route::get('/mytrip', [TripController::class, 'show']);
    Route::post('/mytrip/{slug}/save', [TripController::class, 'save']);
    Route::get('/mytrip/{slug}/remove', [TripController::class, 'delete']);
    Route::delete('/mytrip/{slug}', [TripController::class, 'destroy']);
        /**
     * Show Lists and Details
     */
    # Get here from clicking on a city in /cities. It shows all the places in a city.
    Route::get('/{country}/{city}', [CityController::class, 'show']);

    # Click on a place in /{country}/{city} and see the details of a place. 
    Route::get('/{country}/{city}/{place}', [PlaceController::class, 'show']);

});