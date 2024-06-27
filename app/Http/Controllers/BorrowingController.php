<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BorrowingService;

class BorrowingController extends Controller
{
    protected $borrowingService;

    public function __construct(BorrowingService $borrowingService)
    {
        $this->borrowingService = $borrowingService;
    }


    public function borrowBook(Request $request)
    {
        $request->validate([
            'student_id' => 'required|exists:students,id',
            'book_copy_id' => 'required|exists:book_copies,id',
            'expected_return_at' => 'required|date'
        ]);

        $result = $this->borrowingService->borrowBook($request->all());

        return response()->json($result);
    }


    public function returnBook(Request $request)
    {
        $request->validate([
            'borrowing_id' => 'required|exists:borrowings,id',
            'status' => 'required|in:Good,Damaged,Lost'
        ]);

        $result = $this->borrowingService->returnBook($request->all());

        return response()->json($result);
    }
}
