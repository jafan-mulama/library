<template>

    <div id="app">
        <header>
            <h1>Welcome to My Vue.js App</h1>
        </header>
        <main>
            <div>
        <form @submit.prevent="submitForm">
            <label htmlFor="name">Name:</label>
            <input v-model="formData.name" type="text" id="name"  name="_token" value="{{ csrf_token() }}" required>

            <label htmlFor="publisher">Publisher:</label>
            <input v-model="formData.publisher" type="text" id="publisher" name="_token" value="{{ csrf_token() }}"  required>

            <label htmlFor="isbn">ISBN:</label>
            <input v-model="formData.isbn" type="text" id="isbn" name="_token" value="{{ csrf_token() }}"  required>

            <label htmlFor="category">Category:</label>
            <input v-model="formData.category" type="text" id="category" name="_token" value="{{ csrf_token() }}"  required>

            <label htmlFor="sub_category">Sub Category:</label>
            <input v-model="formData.sub_category" type="text" id="sub_category" name="_token" value="{{ csrf_token() }}"  required>

            <label htmlFor="description">Description:</label>
            <textarea v-model="formData.description" id="description" name="_token" value="{{ csrf_token() }}"  required></textarea>

            <label htmlFor="pages">Pages:</label>
            <input v-model="formData.pages" type="number" id="pages" name="_token" value="{{ csrf_token() }}"  required>

            <label htmlFor="image">Image URL:</label>
            <input v-model="formData.image" type="text" id="image" name="_token" value="{{ csrf_token() }}"  required>

            <label htmlFor="added_by">Added By (User ID):</label>
            <input v-model="formData.added_by" type="number" id="added_by" name="_token" value="{{ csrf_token() }}"  required>

            <button type="submit">Submit</button>
        </form>
            </div>
        </main>
    </div>
</template>
<script>
import axios from "axios";
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
                added_by: 1, // Assuming added_by is an integer
            },
        };
    },
        methods: {
            submitForm() {
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
            mounted() {
                // Retrieve CSRF token from meta tag when the component is mounted
                this.csrfToken = document.head.querySelector('meta[name="csrf-token"]').content;
            },
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
