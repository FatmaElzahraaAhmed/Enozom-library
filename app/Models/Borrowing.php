<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Borrowing extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $fillable = [
        'student_id',
        'book_copy_id',
        'borrowed_at',
        'expected_return_at',
        'returned_at',
        'status_id', 'created_at', 'updated_at', 'deleted_at'
    ];
    public $timestamps = true;

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
