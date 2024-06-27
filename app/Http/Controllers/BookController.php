<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;

class BookController extends Controller
{
    protected $bookService;

    public function __construct(BookService $bookService)
    {
        $this->bookService = $bookService;
    }

    public function statusReport()
    {
        $books = $this->bookService->getStatusReport()->flatMap(function ($book) {
            return $book->copies->map(function ($copy) use ($book) {
                return [
                    'title' => $book->title,
                    'copy_id' => $copy->id,
                    'status' => $copy->status->name,
                ];
            });
        })->sortBy('copy_id')->values()->all();

        return response()->json($books, 200);
    }
}
