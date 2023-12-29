<template>
    <div id="app">
        <header>
            <h1>login page</h1>
        </header>
        <main>
            <div>
    <div class="login-container">
        <form @submit.prevent="login" class="login-form">
            <label >Enter your Login Details</label>
            <br /> <br />
            <input type="email" v-model="loginData.email" required class="input-field" placeholder="Email" name="_token" value="{{ csrf_token() }}" >
            <br />
            <input type="password" v-model="loginData.password" required class="input-field" placeholder="password" name="_token" value="{{ csrf_token() }}" >

            <button type="submit" class="login-button">Login</button>
        </form>
    </div>
            </div>
        </main>
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

            axios.post('/api/login', this.loginData,
                {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.head.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    const {user, token} = response.data;

                    localStorage.setItem('token', token);
                    localStorage.setItem('userRole', user.role);

                    console.log(user);
                    console.log('Login successful!');

                    // Check user role and redirect accordingly
                    if (user.role === 'user') {
                        this.$router.push('/booksLoans');
                    } else if (user.role === 'admin') {
                        this.$router.push('/BookManagement');
                    } else {
                        // Handle other roles or unexpected cases
                        console.error('Unknown user role');
                        //  this.$router.push('/');
                    }
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
