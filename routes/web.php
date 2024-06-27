<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/borrow', [BorrowingController::class, 'borrowBook']);
Route::post('/return', [BorrowingController::class, 'returnBook']);
Route::get('/books/status', [BookController::class, 'statusReport'])->name('books.index');
