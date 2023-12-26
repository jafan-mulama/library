<!-- resources/views/books/books.create.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Add New Book</h1>
        <form action="{{ route('books.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">Book Name</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="publisher">Publisher</label>
                <input type="text" name="publisher" id="publisher" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" name="isbn" id="isbn" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" name="category" id="category" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="sub_category">Sub Category</label>
                <input type="text" name="sub_category" id="sub_category" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>
            <div class="form-group">
                <label for="pages">Number of Pages</label>
                <input type="number" name="pages" id="pages" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="image">Image URL</label>
                <input type="text" name="image" id="image" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="added_by">Added By User ID</label>
                <input type="number" name="added_by" id="added_by" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>
    </div>
@endsection
