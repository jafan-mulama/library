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

// Public routes
// login and register  routes
Route::post('/register', [UserController::class, 'store'])->name('register');
Route::post('/login', [UserController::class, 'login'])->name('login');

// Routes for BookController
Route::get('/books', [BookController::class, 'index'])->name('books.index');
Route::post('books', [BookController::class, 'store'])->name('books.store');
Route::put('/books/{id}', [BookController::class, 'update'])->name('books.update');
Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
Route::delete('/books/{id}', [BookController::class, 'destroy'])->name('books.destroy');
Route::post('/update-database', [BookController::class, 'updateDatabase']);


// Routes for UserController
Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
Route::get('/currentUser', [UserController::class, 'currentUser'])->name('currentUser.show');





// Authenticated routes
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', [UserController::class, 'currentUser'])->name('user.current');
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');

    // Routes for BookController
    // Route::post('/books', [BookController::class, 'store'])->middleware('cors')->name('books.store');
    //Route::get('/books', [BookController::class, 'index'])->name('index');


    // Routes for BookLoanController accessible only by admin users
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        // Book Loan Routes
        Route::get('/book-loans', [BookLoanController::class, 'index'])->name('book_loans.index');
        Route::get('/book-loans/{id}', [BookLoanController::class, 'show'])->name('book_loans.show');
        Route::post('/book-loans/borrow', [BookLoanController::class, 'borrowBook'])->name('book_loans.borrow');
        Route::put('/book-loans/approve/{id}', [BookLoanController::class, 'approveLoan'])->name('book_loans.approve');
        Route::put('/book-loans/extend/{id}', [BookLoanController::class, 'extendLoan'])->name('book_loans.extend');
        Route::put('/book-loans/return/{id}', [BookLoanController::class, 'returnBook'])->name('book_loans.return');
        Route::delete('/book-loans/{id}', [BookLoanController::class, 'destroy'])->name('book_loans.destroy');

        // Admin Dashboard Route (Example)
        Route::get('/admin-dashboard', function () {
            return 'Admin Dashboard';
        });
    });

// Additional route for non-admin users (if needed)
    Route::middleware(['auth:sanctum'])->group(function () {
        // Add any routes that should be accessible by authenticated non-admin users here
    });



// Routes for UserController
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
});

