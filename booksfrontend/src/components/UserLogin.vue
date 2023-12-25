<template>
    <form @submit.prevent="login">
        <label htmlFor="email">Email:</label>
        <input type="email" v-model="loginData.email" required>

        <label htmlFor="password">Password:</label>
        <input type="password" v-model="loginData.password" required>

        <button type="submit">Login</button>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    name: 'UserLogin',
    data() {
        return {
            loginData: {
                email: '',
                password: '',
            },
            error: null,
        };
    },
    methods: {
        login() {
            this.error = null;

            axios.post('http://127.0.0.1:8000/api/login', this.loginData)
                .then(response => {
                    const {user, token} = response.data;

                    localStorage.setItem('token', token);

                    console.log(user);
                    console.log('Login successful!');

                    // Redirect to a new page or another route
                    this.$router.push('/BookLoans');
                })
                .catch(error => {
                    if (error.response && error.response.data && error.response.data.error) {
                        this.error = error.response.data.error;
                    } else {
                        this.error = 'An unexpected error occurred.';
                    }

                    console.error(error);
                });
        },
    },
};
</script>

<style scoped>
/* Add your styles here */
</style>
