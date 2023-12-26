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

    public function create()
    {
        return view('books-create'); // Assuming you have a view file for creating a book
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:200',
            'publisher' => 'required|string|max:50',
            'isbn' => 'required|string|max:50',
            'category' => 'string|max:100',
            'sub_category' => 'string|max:100',
            'description' => 'string',
            'pages' => 'integer',
            'image' => 'string|max:200',
            'added_by' => 'required|integer',
        ]);

        $book = Book::create($validatedData);

        return redirect()->route('books.create')->with('success', 'Book added successfully!');


//        // Validate the incoming request data
//        $request->validate([
//            'name' => 'required|string|max:200',
//            'publisher' => 'required|string|max:50',
//            'isbn' => 'required|string|max:50',
//            'category' => 'required|string|max:100',
//            'sub_category' => 'required|string|max:100',
//            'description' => 'required|string',
//            'pages' => 'required|integer',
//            'image' => 'required|string|max:200',
//            'added_by' => 'required|integer',
//        ]);
//
//        // Create a new book instance and save it to the database
//        $book = new Book([
//            'name' => $request->input('name'),
//            'publisher' => $request->input('publisher'),
//            'isbn' => $request->input('isbn'),
//            'category' => $request->input('category'),
//            'sub_category' => $request->input('sub_category'),
//            'description' => $request->input('description'),
//            'pages' => $request->input('pages'),
//            'image' => $request->input('image'),
//            'added_by' => $request->input('added_by'),
//        ]);
//
//        $book->save();
//        return view('books-Create');
//        // Redirect to the book index page with a success message
//        //return redirect()->route('index')->with('success', 'Book added successfully!');
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
