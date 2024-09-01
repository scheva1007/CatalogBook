<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
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

Route::get('/', [AuthorController::class, 'index'])->name('author.index');
Route::get('/book', [BookController::class, 'allBooks'])->name('book.all');
Route::get('/all', [AuthorController::class, 'allAuthors'])->name('author.all');
Route::get('/create', [AuthorController::class, 'create'])->name('author.create');
Route::get('/createBook', [BookController::class, 'create'])->name('book.create');
Route::post('/author', [AuthorController::class, 'store'])->name('author.store');
Route::post('/authorBook', [BookController::class, 'store'])->name('book.store');
