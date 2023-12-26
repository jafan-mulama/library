<template>
    <div>
        <h1>Add New Book</h1>
        <form @submit.prevent="addBook">
            @csrf <!-- Include the CSRF token here -->
            <div class="form-group">
                <label for="name">Book Name</label>
                <input type="text" v-model="newBook.name" id="name" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="publisher">Publisher</label>
                <input type="text" v-model="newBook.publisher" id="publisher" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="isbn">ISBN</label>
                <input type="text" v-model="newBook.isbn" id="isbn" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="category">Category</label>
                <input type="text" v-model="newBook.category" id="category" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="sub_category">Sub Category</label>
                <input type="text" v-model="newBook.sub_category" id="sub_category" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea v-model="newBook.description" id="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="pages">Number of Pages</label>
                <input type="number" v-model="newBook.pages" id="pages" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="image">Image URL</label>
                <input type="text" v-model="newBook.image" id="image" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="added_by">Added By User ID</label>
                <input type="number" v-model="newBook.added_by" id="added_by" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Add Book</button>
        </form>

        <!-- Display the book list -->
        <h1>Book List</h1>
        <ul>
            <li v-for="book in books" :key="book.id">
                {{ book.name }} - {{ book.publisher }}
            </li>
        </ul>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'AddBook',
    data() {
        return {
            newBook: {
                name: '',
                publisher: '',
                isbn: '',
                category: '',
                sub_category: '',
                description: '',
                pages: '',
                image: '',
                added_by: '',
            },
            books: [],
        };
    },
    methods: {
        async addBook() {
            try {
                const response = await axios.post('http://localhost:8000/books/create', this.newBook);
                console.log('Book added:', response.data);
                this.newBook = {
                    name: '',
                    publisher: '',
                    isbn: '',
                    category: '',
                    sub_category: '',
                    description: '',
                    pages: '',
                    image: '',
                    added_by: '',
                }; // Reset form fields
                await this.fetchBooks(); // Refresh the book list after adding
            } catch (error) {
                console.error('Error adding book:', error);
            }
        },
        async fetchBooks() {
            try {
                const response = await axios.get('http://localhost:8000/books/');
                this.books = response.data; // Assuming the response is an array of books
            } catch (error) {
                console.error('Error fetching books:', error);
            }
        },
    },
    mounted() {
        this.fetchBooks(); // Load books when the component mounts
    },
};
</script>
