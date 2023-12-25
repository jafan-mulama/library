<template>
    <div class="login-container">
        <form @submit.prevent="login" class="login-form">
            <label >Enter your Login Details</label>
            <br /> <br />
            <input type="email" v-model="loginData.email" required class="input-field" placeholder="Email">
            <br />
            <input type="password" v-model="loginData.password" required class="input-field" placeholder="password">

            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
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

.login-container {
    display: flex;
    justify-content: center;
    align-items: flex-start; /* Align to the top of the container */
    height: 100vh; /* Set the height of the container to 100% of the viewport height */
}

.login-form {
    max-width: 300px;
    width: 100%;
    margin-top: 100px; /* Adjust this value to control the distance from the top */
}

.input-field {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}

.login-button {
    background-color: #5446cc;
    color: white;
    padding: 10px 15px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}
</style>
