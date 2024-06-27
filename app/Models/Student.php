<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $fillable = ['student_number', 'name', 'email', 'phone', 'created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;

    public function borrowings()
    {
        return $this->hasMany(Borrowing::class);
    }
}
