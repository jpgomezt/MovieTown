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

Route::get('movie/create', [App\Http\Controllers\MovieController::class, 'create'])->name("movie.create");

Route::post('movie/save', [App\Http\Controllers\MovieController::class, 'save'])->name("movie.save");

Route::get('movie/list', [App\Http\Controllers\MovieController::class, 'list'])->name("movie.list");

Route::get('movie/show/{id}', [App\Http\Controllers\MovieController::class, 'show'])->name("movie.show");

Route::post('movie/delete{id}', [App\Http\Controllers\MovieController::class, 'delete'])->name("movie.delete");

Route::get('movie/filter', [App\Http\Controllers\MovieController::class, 'filter'])->name("movie.filter");
