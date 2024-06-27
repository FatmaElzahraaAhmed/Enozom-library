<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Book;
use App\Models\BookCopy;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $students = [
            ['student_number' => '1', 'name' => 'Ali', 'email' => 'Ali@enozom.com', 'phone' => '0122224400'],
            ['student_number' => '2', 'name' => 'Mohamed', 'email' => 'mohamed@enozom.com', 'phone' => '0111155000'],
            ['student_number' => '3', 'name' => 'Ahmed', 'email' => 'ahmed@enozom.com', 'phone' => '0155553311']
        ];
        Student::insert($students);

        $books = [
            ['title' => 'Clean Code'],
            ['title' => 'Algorithms']
        ];
        Book::insert($books);

        $bookCopies = [
            ['book_id' => 1, 'status_id' => 1],
            ['book_id' => 2, 'status_id' => 1],
            ['book_id' => 1, 'status_id' => 1]
        ];
        BookCopy::insert($bookCopies);
    }
}
