<?php

// In a Laravel model file for the 'User' model (e.g., User.php)
namespace App\Models;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticate;


class User extends Authenticate
{
    use SoftDeletes;

    protected $fillable = [
        'name', 'email_address', 'email', 'password', 'created_at', 'updated_at', 'deleted_at'
    ];

    public function booksAdded()
    {
        return $this->hasMany(Book::class, 'added_by');
    }

    public function loansAdded()
    {
        return $this->hasMany(BookLoan::class, 'added_by');
    }
}
