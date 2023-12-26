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

// Route to show the form for adding a new book
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
// Route to handle the submission of the form and store the book data
Route::post('/books', [BookController::class, 'store'])->name('books.store');



