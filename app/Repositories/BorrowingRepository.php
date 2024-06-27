<?php

namespace App\Repositories;

use App\Models\Borrowing;

class BorrowingRepository
{
    public function create(array $data)
    {
        return Borrowing::create($data);
    }

    public function find($id)
    {
        return Borrowing::find($id);
    }
}
