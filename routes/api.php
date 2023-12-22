<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookLoanController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and assigned to
| the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Routes for BookController
Route::get('/books', [BookController::class, 'index'])->name('index');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');

// Routes for BookLoanController
Route::get('/book-loans', [BookLoanController::class, 'index'])->name('book_loans.index');
Route::get('/book-loans/{id}', [BookLoanController::class, 'show'])->name('book_loans.show');
Route::post('/book-loans', [BookLoanController::class, 'store'])->name('book_loans.store');
Route::put('/book-loans/{id}', [BookLoanController::class, 'update'])->name('book_loans.update');
Route::delete('/book-loans/{id}', [BookLoanController::class, 'destroy'])->name('book_loans.destroy');

// Routes for UserController
Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::post('/users', [UserController::class, 'store'])->name('users.store');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

// Authentication Routes
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', [UserController::class, 'currentUser'])->name('user.current');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
