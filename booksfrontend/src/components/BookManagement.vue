<template>
    <div>
        <h2>Book Management</h2>

        <!-- Display Books -->
        <table>
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Publisher</th>
                <th>ISBN</th>
                <th>Category</th>
                <th>Sub Category</th>
                <th>Description</th>
                <th>Pages</th>
                <th>Image</th>
                <th>Added By (User ID)</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="book in books" :key="book.id">
                <td>{{ book.id }}</td>
                <td>{{ book.name }}</td>
                <td>{{ book.publisher }}</td>
                <td>{{ book.isbn }}</td>
                <td>{{ book.category }}</td>
                <td>{{ book.sub_category }}</td>
                <td>{{ book.description }}</td>
                <td>{{ book.pages }}</td>
                <td>{{ book.image }}</td>
                <td>{{ book.added_by }}</td>
                <td>
                    <button @click="editBook(book.id)">Edit</button>
                    <button @click="deleteBook(book.id)">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>

        <!-- Update Book Modal -->
        <div v-if="editBookId !== null">
            <h3>Edit Book</h3>
            <form @submit.prevent="updateBook">
                <!-- ... (similar to the form structure in your previous example) ... -->
            </form>
        </div>
    </div>
</template>

<script>
import { logout, fetchBooks, updateBook } from '@/api/api';
export default {
    data() {
        return {
            books: [],
            editBookId: null,
            editedBook: {
                name: '',
                publisher: '',
                isbn: '',
                category: '',
                sub_category: '',
                description: '',
                pages: '', // Assuming pages is an integer
                image: '',
                added_by: '', // Assuming added_by is an integer
            },
        };
    },

    methods: {
        // Use the fetchBooks function from api.js
        fetchBooks() {
            fetchBooks()
                .then(books => {
                    this.books = books;
                })
                .catch(error => {
                    console.error('Error fetching books:', error);
                });
        },
        // Use the updateBook function from api.js
        updateBook() {
            updateBook(this.editBookId, this.editedBook)
                .then(() => {
                    this.fetchBooks();
                    this.editBookId = null;
                })
                .catch(error => {
                    console.error('Error updating book:', error);
                });
        },
        /** start of logout method reused import {logout} from "@/api/api"; **/
        async logout() {
            const isLoggedOut = await logout();

            if (isLoggedOut) {
                await this.$router.push('/login');
            } else {
                console.error('Logout failed');
            }
        },

        // TODO: Add methods to fetch the list of books from the API
    },
    mounted() {
        this.fetchBooks();
    },
};
</script>

<style scoped>
/* Container styling */
div {
    margin: 20px;
}

/* Table styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    overflow-x: auto;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

/* Form styling */
form {
    margin-top: 20px;
    display: flex;
    flex-direction: column;
    max-width: 400px;
}

label {
    margin-bottom: 8px;
}

input, textarea {
    margin-bottom: 16px;
    padding: 8px;
    box-sizing: border-box;
}

/* Button styling */
button {
    padding: 8px;
    background-color: #4caf50;
    color: white;
    border: none;
    cursor: pointer;
}

button:hover {
    background-color: #45a049;
}

/* Responsive styles */
@media (max-width: 600px) {
    table {
        overflow-x: auto;
    }
}
</style>
