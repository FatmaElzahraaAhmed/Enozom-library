<?php

namespace App\Services;

use App\Repositories\BorrowingRepository;
use App\Models\BookCopy;
use Illuminate\Support\Facades\DB;

class BorrowingService
{
    protected $borrowingRepository;

    public function __construct(BorrowingRepository $borrowingRepository)
    {
        $this->borrowingRepository = $borrowingRepository;
    }

    public function borrowBook(array $data)
    {
        DB::beginTransaction();

        try {
            $borrowing = $this->borrowingRepository->create([
                'student_id' => $data['student_id'],
                'book_copy_id' => $data['book_copy_id'],
                'borrowed_at' => now(),
                'expected_return_at' => $data['expected_return_at']
            ]);

            $borrowing->status_id = '4';
            $borrowing->save();

            $bookCopy = BookCopy::find($data['book_copy_id']);
            $bookCopy->status_id = '4';
            $bookCopy->save();

            DB::commit();

            return ['status' => 200, 'data' => ['message' => 'Book borrowed successfully']];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 500, 'data' => ['error' => 'An error occurred while borrowing the book']];
        }
    }

    public function returnBook(array $data)
    {
        DB::beginTransaction();

        try {
            $borrowing = $this->borrowingRepository->find($data['borrowing_id']);
            $borrowing->returned_at = now();
            $bookCopy = BookCopy::find($borrowing->book_copy_id);
            if ($data['status'] == 'Good') {
                $bookCopy->status_id = '1';
                $borrowing->status_id = '1';
            } elseif ($data['status'] == 'Damaged') {
                $bookCopy->status_id = '2';
                $borrowing->status_id = '2';
            } elseif ($data['status'] == 'Lost') {
                $bookCopy->status_id = '3';
                $borrowing->status_id = '3';
            } else {
                return ['status' => 400, 'data' => ['error' => 'Invalid status']];
            }


            $borrowing->save();
            $bookCopy->save();

            DB::commit();

            return ['status' => 200, 'data' => ['message' => 'Book returned successfully']];
        } catch (\Exception $e) {
            DB::rollBack();
            return ['status' => 500, 'data' => ['error' => 'An error occurred while returning the book']];
        }
    }
}
