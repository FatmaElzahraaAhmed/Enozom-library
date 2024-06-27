<?php

namespace App\Repositories;

use App\Models\Book;

class BookRepository
{
    public function getAllBooks()
    {
        return Book::with('copies')->get();
    }
}
