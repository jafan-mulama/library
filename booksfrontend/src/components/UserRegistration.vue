<template>
    <form @submit.prevent="register">
        <label for="name">Name:</label>
        <input type="text" v-model="userData.name" required>

        <label for="email">Email:</label>
        <input type="email" v-model="userData.email" required>

        <label for="password">Password:</label>
        <input type="password" v-model="userData.password" required>

        <button type="submit">Register</button>
    </form>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            userData: {
                name: '',
                email: '',
                password: '',
            },
        };
    },
    methods: {
        register() {
            axios.post('/api/register', this.userData)
                .then(response => {
                    console.log(response.data);
                    // Handle success, e.g., redirect to a new page
                })
                .catch(error => {
                    console.error(error);
                    // Handle registration error
                });
        },
    },
};
</script>
