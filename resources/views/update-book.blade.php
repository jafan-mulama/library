<!-- resources/views/update-book.blade.php -->

@extends('layouts.app') {{-- Assuming you have a layout file --}}

@section('content')
    <div>
        <h1>Edit Book</h1>
        <form @submit.prevent="updateBook">
            <div>
                <label for="name">Name:</label>
                <input v-model="book.name" id="name" name="name" required>
            </div>
            <div>
                <label for="publisher">Publisher:</label>
                <input v-model="book.publisher" id="publisher" name="publisher" required>
            </div>
            <!-- Add other input fields for updating book properties -->

            <button type="submit">Update Book</button>
        </form>
    </div>
@endsection
