<template>
    <div id="app">
        <header>
            <h1>login page</h1>
        </header>
        <main>
            <div>
    <form @submit.prevent="register">
        <label htmlFor="name">Name:</label>
        <input type="text" v-model="userData.name" name="_token" value="{{ csrf_token() }}" required>

        <label htmlFor="email">email_address:</label>
        <input type="email" v-model="userData.email_address" name="_token" value="{{ csrf_token() }}" required>

        <label htmlFor="email">Email:</label>
        <input type="email" v-model="userData.email" name="_token" value="{{ csrf_token() }}" required>

        <label htmlFor="password">Password:</label>
        <input type="password" v-model="userData.password" name="_token" value="{{ csrf_token() }}" required>

        <label htmlFor="is_admin">Check to make user Admin:</label>
        <input type="checkbox" v-model="userData.is_admin"  name="_token" value="{{ csrf_token() }}"/>

        <button type="submit">Create User</button>
    </form>
            </div>
        </main>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    name: 'RegisterUsers',
    data() {
        return {
            userData: {
                name: '',
                email_address: '',
                email: '',
                password: '',
                is_admin:  false, // Set the initial value based on whether the user is an admin or not
            },
            error: null, // Add an error property to store error messages
        };
    },
    methods: {
        register() {
            // Reset the error on each registration attempt
            this.error = null;

            // Use the correct URL for your Laravel backend
            axios.post('/api/register', this.userData, {
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                }
            })
                .then(response => {
                    const { user, token } = response.data;
                    // Store the token securely (e.g., in local storage or a cookie)
                    localStorage.setItem('token', token);
                    console.log(user);
                    console.log('Registration successful!');
                })
                .catch(error => {
                    // Check if the error response contains data
                    if (error.response && error.response.data && error.response.data.error) {
                        this.error = error.response.data.error;
                    } else {
                        this.error = 'An unexpected error occurred.';
                    }
                    console.error(error);
                    // Handle registration error
                });
        },
    },
};
</script>

