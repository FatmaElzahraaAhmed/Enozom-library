<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use HasFactory;

    use SoftDeletes;
    protected $dates = ['deleted_at'];


    protected $fillable = ['title', 'created_at', 'updated_at', 'deleted_at'];
    public $timestamps = true;

    public function copies()
    {
        return $this->hasMany(BookCopy::class);
    }
}
