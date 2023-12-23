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
    name: 'UserRegistration',
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
            axios.post("http://127.0.0.1:8000/api/login", this.loginData)
                .then(response => {
                    console.log(response); // Log the entire response for debugging

                    const data = response.data;
                    try {
                        if (data.status === true) {
                            alert("Login Successfully");
                            this.$router.push('/Loans');
                        } else {
                            alert("Login failed");
                        }
                    } catch (err) {
                        alert("Error, please try again");
                    }
                })
                .catch(error => {
                    console.error(error);
                    alert("An unexpected error occurred.");
                });
        },
    },
};
</script>

<style scoped>
/* Add your styles here */
</style>
