<template>
    <header>
        <h1>Create Account</h1>
    </header>
    <div class=".form-container">
    <form  @submit.prevent="register" class="all-form">

        <label>Name:</label>
        <input type="text" v-model="userData.name" class="input-field" required>

        <label htmlFor="email">email_address:</label>
        <input type="email" v-model="userData.email_address"  class="input-field" required>

        <label htmlFor="email">Email:</label>
        <input type="email" v-model="userData.email" class="input-field" required>

        <label htmlFor="password">Password:</label>
        <input type="password" v-model="userData.password" class="input-field" required>

        <button type="submit" class="buttons">Register</button>
    </form>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    name: 'UserRegistration',
    data() {
        return {
            userData: {
                name: '',
                email_address: '',
                email: '',
                password: '',
            },
            error: null, // Add an error property to store error messages
        };
    },
    methods: {
        register() {
            // Reset the error on each registration attempt
            this.error = null;

            // Use the correct URL for your Laravel backend
            axios.post('/api/register', this.userData)
                .then(response => {
                    const { user, token } = response.data;

                    // Store the token securely (e.g., in local storage or a cookie)
                    localStorage.setItem('token', token);

                    console.log(user);
                    console.log('Registration successful!');

                    // Redirect to a new page or another route
                    this.$router.push('/login');
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

