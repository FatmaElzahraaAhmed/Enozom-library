<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id',
        'book_copy_id',
        'borrowed_at',
        'expected_return_at',
        'returned_at',
        'status_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function bookCopy()
    {
        return $this->belongsTo(BookCopy::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
