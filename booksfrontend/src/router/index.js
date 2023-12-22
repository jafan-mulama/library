
import { createRouter, createWebHistory } from 'vue-router';
import UserRegistration from '../components/UserRegistration.vue';
import BookManagement from '../components/BookManagement.vue';
import BookLoans from '../components/BookLoans.vue';

const routes = [
    { path: '/user-registration', component: UserRegistration },
    { path: '/book-management', component: BookManagement },
    { path: '/book-loans', component: BookLoans },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
