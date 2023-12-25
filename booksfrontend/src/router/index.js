
import { createRouter, createWebHistory } from 'vue-router'
import HelloWorld from "@/components/HelloWorld.vue";
import UserLogin from "@/components/UserLogin.vue";
import BookLoans from "@/components/BookLoans.vue";
import UserRegistration from "@/components/UserRegistration.vue";
import BookManagement from "@/components/BookManagement.vue";


const routes = [
    {
        path: '/',
        name: 'HelloWorld',
        component: HelloWorld
    },
    {
        path: '/Registration',
        name: 'UserRegistration',
        component:  UserRegistration
    },
    {
        path: '/login',
        name: 'UserLogin',
        component:  UserLogin
    },

    {
        path: '/booksloans',
        name: 'BookLoans',
        component:  BookLoans,
        beforeEnter: (to, from, next) => {
            const userRole = localStorage.getItem('userRole');
            // Check if the user is authenticated and has the user role
            if (userRole === 'user') {
                next(); // Allow access
            } else {
                // Redirect to a different route or show an error message
                next('/login'); // Redirect to the home page, for example
            }
        }
    },
    {
        path: '/BookManagement',
        name: 'BookManagement',
        component: BookManagement,
        beforeEnter: (to, from, next) => {
            const userRole = localStorage.getItem('userRole');

            // Check if the user is authenticated and has the 'admin' role
            if (userRole === 'admin') {
                next(); // Allow access
            } else {
                // Redirect to a different route or show an error message
                next('/login'); // Redirect to the home page, for example
            }
        },
    }
]
const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});
// Navigation guard to check authentication and admin privileges
export default router;
