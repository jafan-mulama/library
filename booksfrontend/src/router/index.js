import { createApp } from 'vue';
import { createRouter, createWebHashHistory } from 'vue-router';
import BookManagement from "@/components/BookManagement.vue";
import BookLoans from "@/components/BookLoans.vue";
import UserRegistration from "@/components/UserRegistration.vue";
import HelloWorld from "@/components/HelloWorld.vue";

// Create the router instance
const router = createRouter({
    history: createWebHashHistory(), // Use hash mode
    routes: [
        { path: '/', component: HelloWorld }, // Root path
        { path: '/book-management', component: BookManagement },
        { path: '/book-loans', component: BookLoans },
        { path: '/register', component: UserRegistration },
        // { path: '/login', component: UserLogin }, // Uncomment when needed
        // { path: '/profile', component: UserProfile }, // Uncomment when needed
    ],
});

const app = createApp({
    template: '<div id="app"><router-view/></div>', // Adjust this based on your component structure
});

app.use(router); // Use the router instance
app.mount('#app');
