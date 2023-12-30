<template>
    <div id="app">
        <header>
            <h1>Login Page</h1>
        </header>
        <main>
            <div>
                <div class="form-container">
                    <form @submit.prevent="login" class="all-form">
                        <label>Enter your Login Details</label>
                        <br /> <br />

                        <input type="email" v-model="loginData.email" required placeholder="Email" class="input-field">
                        <br />
                        <input type="password" v-model="loginData.password" required class="input-field" placeholder="Password">

                        <button type="submit" class="buttons">Login</button>
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
                    localStorage.setItem('userId', user.id); // Store the user ID

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



.input-field {
    width: 100%;
    padding: 8px;
    margin-bottom: 16px;
    box-sizing: border-box;
}


</style>
