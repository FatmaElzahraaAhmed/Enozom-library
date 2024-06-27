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
        $books = $this->bookService->getStatusReport();

        return response()->json($books, 200);
    }
}
