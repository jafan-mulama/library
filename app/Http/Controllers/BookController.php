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
        $request->validate([
            'name' => 'required|string|max:200',
            'publisher' => 'required|string|max:50',
            'isbn' => 'required|string|max:50',
            'category' => 'required|string|max:100',
            'sub_category' => 'required|string|max:100',
            'description' => 'required|string',
            'pages' => 'required|integer',
            'image' => 'required|string|max:200',
            'added_by' => 'required|exists:users,id',
        ]);

        // Create a new book record
        $book = Book::create($request->all());

        return response()->json(['book' => $book], 201);
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'string|max:200',
            'publisher' => 'string|max:50',
            'isbn' => 'string|max:50',
            'category' => 'string|max:100',
            'sub_category' => 'string|max:100',
            'description' => 'string',
            'pages' => 'integer',
            'image' => 'string|max:200',
            'added_by' => 'exists:users,id',
        ]);

        // Find the book by ID
        $book = Book::findOrFail($id);

        // Update the book with the new data
        $book->update($request->all());

        return response()->json(['book' => $book]);
    }


    public function destroy($id)
    {
        // Find the book by ID
        $book = Book::findOrFail($id);

        // Delete the book
        $book->delete();

        return response()->json(['message' => 'Book deleted successfully']);
    }

}
