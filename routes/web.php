<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name("home.index");

Auth::routes();

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('user/list', [App\Http\Controllers\UserController::class, 'list'])->name('user.list');
Route::get('user/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user.show');
Route::get('user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete'])->name('user.delete');
Route::get('user/save', [App\Http\Controllers\UserController::class, 'save'])->name('user.save');
Route::get('user/addViewedMovie/{id}', [App\Http\Controllers\UserController::class, 'addViewedMovie'])->name('user.addViewedMovie');

Route::get('watchlist/create', [App\Http\Controllers\WatchlistController::class, 'create'])->name('watchlist.create');
Route::get('watchlist/list', [App\Http\Controllers\WatchlistController::class, 'list'])->name('watchlist.list');
Route::get('watchlist/show/{id}', [App\Http\Controllers\WatchlistController::class, 'show'])->name('watchlist.show');
Route::post('watchlist/save', [App\Http\Controllers\WatchlistController::class, 'save'])->name('watchlist.save');
Route::post('watchlist/delete/{id}', [App\Http\Controllers\WatchlistController::class, 'delete'])->name('watchlist.delete');
Route::get('watchlist/addMovie', [App\Http\Controllers\WatchlistController::class, 'addMovie'])->name('watchlist.addMovie');
Route::get('watchlist/addMovie/{id}', [App\Http\Controllers\WatchlistController::class, 'addMovie'])->name('watchlist.addMovie');
Route::get('watchlist/removeMovie', [App\Http\Controllers\WatchlistController::class, 'removeMovie'])->name('watchlist.removeMovie');
Route::get('watchlist/removeMovie/{id}', [App\Http\Controllers\WatchlistController::class, 'removeMovie'])->name('watchlist.removeMovie');

Route::get('movie/create', [App\Http\Controllers\MovieController::class, 'create'])->name("movie.create");
Route::post('movie/save', [App\Http\Controllers\MovieController::class, 'save'])->name("movie.save");
Route::get('movie/list', [App\Http\Controllers\MovieController::class, 'list'])->name("movie.list");
Route::get('movie/show/{id}', [App\Http\Controllers\MovieController::class, 'show'])->name("movie.show");
Route::post('movie/delete{id}', [App\Http\Controllers\MovieController::class, 'delete'])->name("movie.delete");
Route::get('movie/filter', [App\Http\Controllers\MovieController::class, 'filter'])->name("movie.filter");
