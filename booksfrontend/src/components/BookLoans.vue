<template>
    <form @submit.prevent="login">
        <label for="email">Email:</label>
        <input type="email" v-model="credentials.email" required>

        <label for="password">Password:</label>
        <input type="password" v-model="credentials.password" required>

        <button type="submit">Login</button>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            credentials: {
                email: '',
                password: '',
            },
        };
    },
    methods: {
        login() {
            axios.post('/api/login', this.credentials)
                .then(response => {
                    console.log(response.data);
                    // Handle successful login, e.g., redirect to a dashboard
                })
                .catch(error => {
                    console.error(error);
                    // Handle login error
                });
        },
    },
};
</script>
