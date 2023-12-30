<template>
    <div>
        <h2>Book Management</h2>

        <!-- Display Books -->
        <button @click="logout">Logout</button>
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


        <div v-if="editBookId !== null">
            <!-- Update Book Form -->
            <form ref="editForm" @submit.prevent="updateBook">
                <h3>Edit Book</h3>
                <!-- Name Field -->
                <label for="name">Name:</label>
                <input v-model="editedBook.name" type="text" id="name" required autocomplete="off">

                <!-- Publisher Field -->
                <label for="publisher">Publisher:</label>
                <input v-model="editedBook.publisher" type="text" id="publisher" required autocomplete="off">

                <!-- ISBN Field -->
                <label for="isbn">ISBN:</label>
                <input v-model="editedBook.isbn" type="text" id="isbn" required autocomplete="off">

                <!-- Other Fields ... -->

                <!-- Pages Field -->
                <label for="pages">Pages:</label>
                <input v-model="editedBook.pages" type="number" id="pages" required autocomplete="off">

                <!-- Image Field -->
                <label for="image">Image URL:</label>
                <input v-model="editedBook.image" type="text" id="image" required autocomplete="off">

                <!-- Added By Field -->
                <label for="added_by">Added By (User ID):</label>
                <input v-model="editedBook.added_by" type="number" id="added_by" required autocomplete="off">

                <!-- Update Button -->
                <button type="submit">Update</button>

            </form>
            </div>
        </div>
</template>

<script>
import {logout, fetchBooks, updateBook, deleteBook, getBookById} from '@/api/api';
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

        // deleteBook function from api.js
        deleteBook(bookId) {
            // Call the deleteBook function from api.js
            deleteBook(bookId)
                .then(() => {
                    this.fetchBooks(); // Refresh the book list after deletion
                })
                .catch(error => {
                    console.error('Error deleting book:', error);
                });
        },


        editBook(bookId) {
            getBookById(bookId) // Use the getBookById function to fetch book details
                .then(book => {
                    // Assign book details to editedBook
                    this.editedBook = { ...book };
                    this.editBookId = bookId; // Set the book ID to initiate the edit
                    this.scrollToEditForm();
                })
                .catch(error => {
                    console.error('Error fetching book details for edit:', error);
                });
        },
        scrollToEditForm() { // Find the edit form element using a ref
            const editFormElement = this.$refs.editForm; // Check if the element exists before scrolling
            if (editFormElement) {// Scroll the element into view
                editFormElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
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
