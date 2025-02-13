<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToppageController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ArticlesController;

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

Route::get('/', [ToppageController::class, 'index'])->name('toppage.index')->middleware('guest');

Auth::routes();

Route::get('articles/search', [ArticlesController::class, 'search'])->name('articles.search')->middleware('auth');
Route::get('articles/select_articles', [ArticlesController::class, 'select_articles'])->name('articles.select_articles')->middleware('auth');
Route::resource('categories', CategoriesController::class)->only(['create', 'store'])->middleware('auth');
Route::resource('articles', ArticlesController::class)->except(['show'])->middleware('auth');



