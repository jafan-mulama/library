<?php

// In a Laravel model file for the 'Book' model (e.g., Book.php)
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Book extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'publisher', 'isbn', 'category', 'sub_category', 'description',
        'pages', 'image', 'added_by', 'created_at', 'updated_at', 'deleted_at'
    ];


    public function loans()
    {
        return $this->hasMany(BookLoan::class, 'book_id');
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
