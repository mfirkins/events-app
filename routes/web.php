<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VenueController;


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




Auth::routes();

Route::get('/', [EventController::class, 'index'])->name('home');


Route::get('/create', [EventController::class, 'create'])->name('create_event');

Route::get('/{id}', [EventController::class, 'show']);

Route::post('/venues', [VenueController::class, 'store'])->name('store_venue');

Route::get('/venues/create', [VenueController::class, 'create'])->name('create_venue');

Route::get('/category/{id}', [CategoryController::class, 'show']);