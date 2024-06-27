<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/borrow', [BorrowingController::class, 'borrowBook']);
Route::post('/return', [BorrowingController::class, 'returnBook']);
Route::get('/books/status', [BookController::class, 'statusReport'])->name('books.index');
