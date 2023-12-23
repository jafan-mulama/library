<template>
    <div class="hello">
        <h1>{{ msg }}</h1>
        <p>
            For a guide and recipes on how to configure / customize this project,<br>
            check out the
            <a href="https://cli.vuejs.org" target="_blank" rel="noopener">vue-cli documentation</a>.
        </p>
        <!-- ... (rest of your template) ... -->

        <form @submit.prevent="register">
            <label htmlFor="name">Name:</label>
            <input type="text" v-model="userData.name" required>

            <label htmlFor="email">email_address:</label>
            <input type="email" v-model="userData.email_address" required>

            <label htmlFor="email">Email:</label>
            <input type="email" v-model="userData.email" required>

            <label htmlFor="password">Password:</label>
            <input type="password" v-model="userData.password" required>

            <button type="submit">Register</button>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'HelloWorld',
    props: {
        msg: String
    },
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
            axios.post('http://localhost:8000/api/register', this.userData)
                .then(response => {
                    const { user, token } = response.data;

                    // Store the token securely (e.g., in local storage or a cookie)
                    localStorage.setItem('token', token);

                    console.log(user);
                    console.log('Registration successful!');

                    // Redirect to a new page or another route
                    this.$router.push('/BookLoans');
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

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
h3 {
    margin: 40px 0 0;
}
ul {
    list-style-type: none;
    padding: 0;
}
li {
    display: inline-block;
    margin: 0 10px;
}
a {
    color: #42b983;
}
</style>
