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
            if (BookCopy::find($data['book_copy_id'])->status_id != '1') {
                return ['status' => 400, 'data' => ['error' => 'Book is not available for borrowing']];
            }
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
            $borrowing = $this->borrowingRepository->find($data['copy_id']);
            if (!$borrowing) {
                return ['status' => 404, 'data' => ['error' => 'Book is not borrowed']];
            }
            if ($borrowing->status_id != '4') {
                return ['status' => 400, 'data' => ['error' => 'Book has already been returned']];
            }
            if ($data['status_id'] == '4' ) {
                return ['status' => 400, 'data' => ['error' => 'Book cannot be returned with status borrowed']];
            }
            $borrowing->returned_at = now();
            $bookCopy = BookCopy::find($borrowing->book_copy_id);
            $bookCopy->status_id = $data['status_id'];
            $borrowing->status_id = $data['status_id'];



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
