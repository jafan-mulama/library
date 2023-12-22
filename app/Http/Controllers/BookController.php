<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();
        return response()->json(['books' => $books]);
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return response()->json(['book' => $book]);
    }

    public function store(Request $request)
    {
        // Validation and creation logic here
    }

    public function update(Request $request, $id)
    {
        // Update logic here
    }

    public function destroy($id)
    {
        // Deletion logic here
    }
}
