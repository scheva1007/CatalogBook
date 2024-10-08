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
Route::get('/showBook/{book}', [BookController::class, 'show'])->name('book.show');
Route::get('/authorBook/{author}', [AuthorController::class, 'show'])->name('author.show');
Route::get('/author/{author}/edit', [AuthorController::class, 'edit'])->name('author.edit');
Route::get('/book/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::put('/book/{book}', [BookController::class, 'update'])->name('book.update');
Route::put('/author/{author}', [AuthorController::class, 'update'])->name('author.update');
Route::delete('/book/{book}', [BookController::class, 'destroy'])->name('book.destroy');
Route::delete('/author/{author}', [AuthorController::class, 'destroy'])->name('author.destroy');
