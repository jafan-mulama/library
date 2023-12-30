<template>
    <div id="app">
        <header>
            <h1>Welcome to My Vue.js App</h1>
        </header>
        <main>
            <div class="form-container">
                <form @submit.prevent="submitForm" class="all-form">
                    <label for="name">Name:</label>
                    <input v-model="formData.name" type="text" id="name" required class="input-field">

                    <label for="publisher">Publisher:</label>
                    <input v-model="formData.publisher" type="text" id="publisher" required class="input-field">

                    <label for="isbn">ISBN:</label>
                    <input v-model="formData.isbn" type="text" id="isbn" required class="input-field">

                    <label for="category">Category:</label>
                    <input v-model="formData.category" type="text" id="category" required class="input-field">

                    <label for="sub_category">Sub Category:</label>
                    <input v-model="formData.sub_category" type="text" id="sub_category" required class="input-field">

                    <label for="description">Description:</label>
                    <textarea v-model="formData.description" id="description" required class="input-field"></textarea>

                    <label for="pages">Pages:</label>
                    <input v-model="formData.pages" type="number" id="pages" required class="input-field">

                    <label for="image">Image URL:</label>
                    <input v-model="formData.image" type="text" id="image" required class="input-field">

                    <label for="added_by">Added By (User ID):</label>
                    <input v-model="formData.added_by" type="number" id="added_by"  value="addedByFromDatabase" required class="input-field" disabled>

                    <button type="submit" class="buttons">Submit</button>
                </form>
            </div>
        </main>
    </div>
</template>
<script>
import axios from "axios";
import { fetchUserId,fetchCurrentUserDetails  } from '@/api/api';
export default {
    name: '/AddBook',
    data() {
        return {
            formData: {
                name: 'maths',
                publisher: 'jafan',
                isbn: '123456',
                category: 'hkjh',
                sub_category: 'trdt',
                description: 'asdfghjk',
                pages: 1, // Assuming pages is an integer
                image: 'h.jpg',
                added_by: null, // Assuming added_by is an integer
            },
            addedByFromDatabase: null,
            currentUserDetails: null,
        };
    },
        methods: {
            async submitForm() {
                // Fetch user ID from the server before submitting the form
                await this.fetchAddedByFromDatabase();
                // Send the form data to the server using an HTTP request (e.g., Axios)
                axios.post('http://localhost:8080/api/books', this.formData, {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                    }
                })
                    .then(response => {
                        console.log('Data submitted successfully:', response.data);
                        // this.resetForm();
                    })
                    .catch(error => {
                        console.error('Error submitting data:', error);
                    });
            },
            async fetchAddedByFromDatabase() {
                // Make use of the utility function to fetch user ID
                try {
                    this.addedByFromDatabase = await fetchUserId();
                    this.formData.added_by = this.addedByFromDatabase;

                    // Fetch details for the currently authenticated user
                    this.currentUserDetails = await fetchCurrentUserDetails();
                } catch (error) {
                    // Handle the error (if needed)
                }
            },
        },
            mounted() {
                // Fetch user ID from the database when the component is mounted
                this.fetchAddedByFromDatabase();
                // Retrieve CSRF token from meta tag when the component is mounted
                this.csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            },

        // resetForm() {
        //     // Reset form fields after successful submission
        //     this.formData = {
        //         name: '',
        //         publisher: '',
        //         isbn: '',
        //         category: '',
        //         sub_category: '',
        //         description: '',
        //         pages: 0,
        //         image: '',
        //         added_by: 0,
        //     };
        // },
};
</script>

<style scoped>
/* Add your component-specific styles here */
</style>
