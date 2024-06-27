<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = ['student_number', 'name', 'email', 'phone'];

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
