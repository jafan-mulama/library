<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Routes for creating and storing a new book
//Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
//Route::post('/books', [BookController::class, 'store'])->name('books.store');
//
//// Routes for listing books and editing a specific book
//Route::get('/books', [BookController::class, 'index'])->name('books.index');
//Route::get('/books/{id}/edit', [BookController::class, 'edit'])->name('books.edit');    ` `


