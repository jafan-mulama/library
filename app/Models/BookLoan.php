<?php

// In a Laravel model file for the 'BookLoan' model (e.g., BookLoan.php)
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookLoan extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'book_id', 'loan_date', 'due_date', 'return_date',
        'extended', 'extension_date', 'penalty_amount', 'penalty_status',
        'status', 'added_by', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function addedByUser()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
