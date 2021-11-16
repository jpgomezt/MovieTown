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

Route::get('watchlist/create', [App\Http\Controllers\WatchlistController::class, 'create'])->name('watchlist.create');
Route::get('watchlist/list', [App\Http\Controllers\WatchlistController::class, 'list'])->name('watchlist.list');
Route::get('watchlist/show/{id}', [App\Http\Controllers\WatchlistController::class, 'show'])->name('watchlist.show');
Route::post('watchlist/save', [App\Http\Controllers\WatchlistController::class, 'save'])->name('watchlist.save');
Route::post('watchlist/delete/{id}', [App\Http\Controllers\WatchlistController::class, 'delete'])->name('watchlist.delete');
Route::post('watchlist/addMovie', [App\Http\Controllers\WatchlistController::class, 'addMovie'])->name('watchlist.addMovie');
Route::post('watchlist/removeMovie/{id}', [App\Http\Controllers\WatchlistController::class, 'removeMovie'])->name('watchlist.removeMovie');

Route::get('movie/list', [App\Http\Controllers\MovieController::class, 'list'])->name("movie.list");
Route::get('movie/show/{id}', [App\Http\Controllers\MovieController::class, 'show'])->name("movie.show");
Route::post('movie/filter', [App\Http\Controllers\MovieController::class, 'filter'])->name("movie.filter");

Route::post('review/create/{id}', [App\Http\Controllers\ReviewController::class, 'create'])->name("review.create");
Route::post('review/save', [App\Http\Controllers\ReviewController::class, 'save'])->name("review.save");
Route::get('review/list', [App\Http\Controllers\ReviewController::class, 'list'])->name("review.list");
Route::get('review/show/{id}', [App\Http\Controllers\ReviewController::class, 'show'])->name("review.show");
Route::post('review/delete/{id}', [App\Http\Controllers\ReviewController::class, 'delete'])->name("review.delete");
Route::get('review/update/{id}', [App\Http\Controllers\ReviewController::class, 'update'])->name("review.update");
Route::post('review/saveUpdate/{id}', [App\Http\Controllers\ReviewController::class, 'saveUpdate'])->name("review.saveUpdate");


Route::get('order/list', [App\Http\Controllers\OrderController::class, 'list'])->name("order.list");
Route::get('order/show/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name("order.show");
Route::post('order/delete/{id}', [App\Http\Controllers\OrderController::class, 'delete'])->name("order.delete");
Route::get('order/ordersPdf', [App\Http\Controllers\OrderController::class, 'ordersPdf'])->name('order.ordersPdf');

Route::get('item/list/{id}', [App\Http\Controllers\ItemController::class, 'list'])->name("item.list");

Route::post('cart/add', [App\Http\Controllers\CartController::class, 'add'])->name("cart.add");
Route::get('cart/show', [App\Http\Controllers\CartController::class, 'show'])->name("cart.show");
Route::get('cart/empty', [App\Http\Controllers\CartController::class, 'empty'])->name("cart.empty");
Route::post('cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name("cart.checkout");

Route::get('admin/home', [App\Http\Controllers\HomeController::class, 'home'])->name('admin.home');

Route::get('admin/movie/list', [App\Http\Controllers\MovieController::class, 'list'])->name('admin.movie.list');
Route::get('admin/movie/show/{id}', [App\Http\Controllers\MovieController::class, 'show'])->name('admin.movie.show');
Route::get('admin/movie/create', [App\Http\Controllers\MovieController::class, 'create'])->name('admin.movie.create');
Route::post('admin/movie/filter', [App\Http\Controllers\MovieController::class, 'filter'])->name('admin.movie.filter');
Route::get('admin/movie/update/{id}', [App\Http\Controllers\MovieController::class, 'update'])->name('admin.movie.update');
Route::post('admin/movie/saveUpdate', [App\Http\Controllers\MovieController::class, 'saveUpdate'])->name("admin.movie.saveUpdate");
Route::post('admin/movie/save', [App\Http\Controllers\MovieController::class, 'save'])->name("admin.movie.save");
Route::post('admin/movie/delete/{id}', [App\Http\Controllers\MovieController::class, 'delete'])->name("admin.movie.delete");

Route::get('admin/watchlist/list', [App\Http\Controllers\WatchlistController::class, 'list'])->name('admin.watchlist.list');
Route::get('admin/watchlist/create', [App\Http\Controllers\WatchlistController::class, 'create'])->name('admin.watchlist.create');
Route::get('admin/watchlist/show/{id}', [App\Http\Controllers\WatchlistController::class, 'show'])->name('admin.watchlist.show');
Route::post('admin/watchlist/save', [App\Http\Controllers\WatchlistController::class, 'save'])->name('admin.watchlist.save');
Route::post('admin/watchlist/delete/{id}', [App\Http\Controllers\WatchlistController::class, 'delete'])->name('admin.watchlist.delete');
Route::post('admin/watchlist/removeMovie/{id}', [App\Http\Controllers\WatchlistController::class, 'removeMovie'])->name('admin.watchlist.removeMovie');

Route::post('admin/review/create/{id}', [App\Http\Controllers\ReviewController::class, 'create'])->name('admin.review.create');
Route::get('admin/review/list', [App\Http\Controllers\ReviewController::class, 'list'])->name('admin.review.list');
Route::post('admin/review/save', [App\Http\Controllers\ReviewController::class, 'save'])->name("adminreview.save");
Route::get('admin/review/show/{id}', [App\Http\Controllers\ReviewController::class, 'show'])->name("admin.review.show");
Route::post('admin/review/delete/{id}', [App\Http\Controllers\ReviewController::class, 'delete'])->name("admin.review.delete");
Route::get('admin/review/update/{id}', [App\Http\Controllers\ReviewController::class, 'update'])->name("admin.review.update");
Route::post('admin/review/updateProcess/{id}', [App\Http\Controllers\ReviewController::class, 'updateProcess'])->name("admin.review.updateProcess");

Route::get('admin/order/show/{id}', [App\Http\Controllers\OrderController::class, 'show'])->name('admin.order.show');
Route::post('admin/order/delete/{id}', [App\Http\Controllers\OrderController::class, 'delete'])->name('admin.order.delete');
Route::get('admin/order/list', [App\Http\Controllers\OrderController::class, 'list'])->name('admin.order.list');

Route::get('admin/item/list/{id}', [App\Http\Controllers\ItemController::class, 'list'])->name('admin.item.list');

// Consuming APIs
Route::get('consumeApi', [App\Http\Controllers\Api\ThisController::class, 'apiNoKey'])->name('consume.api');
