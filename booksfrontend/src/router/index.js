
import { createRouter, createWebHistory } from 'vue-router';
import BookManagement from "@/components/BookManagement.vue";
import BookLoans from "@/components/BookLoans.vue";
import UserRegistration from "@/components/UserRegistration.vue";



const routes = [
    { path: '/book-management', component: BookManagement },
    { path: '/book-loans', component: BookLoans },
    { path: '/register', component: UserRegistration },
    // { path: '/login', component: UserLogin },
    // { path: '/profile', component: UserProfile },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
