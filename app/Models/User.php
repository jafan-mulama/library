<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticate;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticate
{
    use HasFactory, HasApiTokens, SoftDeletes;

    protected $fillable = [
        'name', 'email_address', 'email','password','role', 'created_at', 'updated_at', 'deleted_at'
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
