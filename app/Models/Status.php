<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    protected $fillable = ['name'];
    public $timestamps = false;

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class); 
    }
    public function bookCopies()
    {
        return $this->hasMany(BookCopy::class); 
    }
}
