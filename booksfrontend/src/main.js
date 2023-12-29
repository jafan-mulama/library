import { createApp } from 'vue';
import App from './App.vue';
import router from './router';
import axios from 'axios';

// Get the CSRF token value from the meta tag
const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
// Set CSRF token as a default header for all Axios requests
axios.defaults.headers.common['X-CSRF-TOKEN'] = csrfToken;


const app = createApp(App);

app.use(router);

app.mount('#app');

