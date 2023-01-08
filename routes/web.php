<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\UserController;



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

//Category Routes
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('categories.show');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
Route::post('/categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');

//Comment Routes

Route::post('/comments/like/', [CommentController::class, 'liked'])->name('comments.liked');
Route::post('/comments/{id}', [CommentController::class, 'update'])->name('comments.update');
Route::get('/comments/{id}/edit', [CommentController::class, 'edit'])->name('comments.edit');
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store');
Route::get('/comments', [CommentController::class, 'index'])->name('comments.index');
Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');


//Profile Routes

Route::get('/profiles/{id}', [ProfileController::class, 'show'])->name('profiles.show');
Route::post('/profiles/{id}', [ProfileController::class, 'update'])->name('profiles.update');
Route::get('/profiles/{id}/edit', [ProfileController::class, 'edit'])->name('profiles.edit');

//Venue Routes
Route::delete('/venues/{id}', [VenueController::class, 'destroy'])->name('venues.destroy');
Route::get('/venues', [VenueController::class, 'index'])->name('venues.index');
Route::post('/venues', [VenueController::class, 'store'])->name('store_venue');
Route::get('/venues/create', [VenueController::class, 'create'])->name('create_venue');
Route::get('/venues/{id}', [VenueController::class, 'show']);
Route::post('/venues/{id}', [VenueController::class, 'update'])->name('venues.update');
Route::get('/venues/{id}/edit', [VenueController::class, 'edit'])->name('venues.edit');

//User Routes - For admins only & owners
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
Route::get('/users', [UserController::class, 'index'])->name('users.index');

//Event Routes - Use the default URL with no suffix
Route::get('/create', [EventController::class, 'create'])->name('create_event')->middleware('can:create-events');
Route::post('/{id}', [EventController::class, 'update'])->name('events.update');
Route::get('/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::delete('/{id}', [EventController::class, 'destroy'])->name('events.destroy');

Route::get('/{id}', [EventController::class, 'show'])->name('events.show');
Route::get('/', [EventController::class, 'index'])->name('home');
Route::post('/', [EventController::class, 'store'])->name('events.store');