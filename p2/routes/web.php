<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannerController;
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

Route::get('/planner', [PlannerController::class, 'index']);
Route::get('/create', [PlannerController::class, 'create']);
Route::get('/planner/show', [PlannerController::class, 'show']);