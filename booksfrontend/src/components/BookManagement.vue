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
                <th>Added By <br>(User ID)</th>
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
                    <button @click="editBook(book.id)">Double click to Edit</button> &nbsp;
                    <button @click="deleteBook(book.id)" class="deleteButton">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>


        <div v-if="editBookId !== null">
            <form ref="editForm" @submit.prevent="updateBook">
                <h3>Edit Book</h3>
                <label for="name">Name:</label>
                <input v-model="editedBook.name" type="text" id="name" required autocomplete="off">
                <label for="publisher">Publisher:</label>
                <input v-model="editedBook.publisher" type="text" id="publisher" required autocomplete="off">
                <label for="isbn">ISBN:</label>
                <input v-model="editedBook.isbn" type="text" id="isbn" required autocomplete="off">
                <label for="category">Category:</label>
                <input v-model="editedBook.category" type="text" id="publisher" required autocomplete="off">
                <label for="sub_category">Sub Category:</label>
                <input v-model="editedBook.sub_category" type="text" id="publisher" required autocomplete="off">
                <label for="description">Description:</label>
                <textarea v-model="editedBook.description" type="textarea" id="publisher" required autocomplete="off"> </textarea>
                <label for="pages">Pages:</label>
                <input v-model="editedBook.pages" type="number" id="pages" required autocomplete="off">
                <label for="image">Image URL:</label>
                <input v-model="editedBook.image" type="text" id="image" required autocomplete="off">
                <label for="added_by">Added By (User ID):</label>
                <input v-model="editedBook.added_by" type="number" id="added_by" value="addedByFromDatabase" required
                       autocomplete="off" disabled>
                <button type="submit" class="updateButton">Update</button>
            </form>
        </div>
    </div>
</template>

<script>
import {logout, fetchBooks, updateBook, deleteBook, getBookById, fetchCurrentUserDetails, fetchUserId} from '@/api/api';

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
                added_by: null, // Assuming added_by is an integer
            },
            addedByFromDatabase: null,
            currentUserDetails: null,
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
        async updateBook() {
            // Fetch user ID from the server before submitting the form
            await this.fetchAddedByFromDatabase();
            // Assign the user ID to the added_by field
            this.editedBook.added_by = this.addedByFromDatabase;
            // Update the book with the edited details
            await updateBook(this.editBookId, this.editedBook);
            updateBook(this.editBookId, this.editedBook)
                .then(() => {
                    this.fetchBooks();
                    this.editBookId = null;
                })
                .catch(error => {
                    console.error('Error updating book:', error);
                });
        },
        async fetchAddedByFromDatabase() {
            // Make use of the utility function to fetch user ID
            try {
                this.addedByFromDatabase = await fetchUserId();
                // Assign the user ID to the added_by field in the editedBook object
                this.editedBook.added_by = this.addedByFromDatabase;

                // Fetch details for the currently authenticated user
                this.currentUserDetails = await fetchCurrentUserDetails();
            } catch (error) {
                // Handle the error (if needed)
            }
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
                    this.editedBook = {...book};
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
                editFormElement.scrollIntoView({behavior: 'smooth', block: 'start'});
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
        // Fetch user ID from the database when the component is mounted
        this.fetchAddedByFromDatabase();
    },
};
</script>

<style scoped>


</style>
