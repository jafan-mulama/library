import {createRouter, createWebHistory} from 'vue-router'
import HelloWorld from "@/components/HelloWorld.vue";
import UserLogin from "@/components/UserLogin.vue";
import BookLoans from "@/components/BookLoans.vue";
import UserRegistration from "@/components/UserRegistration.vue";
import BookManagement from "@/components/BookManagement.vue";
import RegisterUsers from "@/components/RegisterUsers.vue";
import {requireUserRole} from "@/api/api";


const routes = [
    {path: '/', name: 'HelloWorld', component: HelloWorld},
    {path: '/Registration', name: 'UserRegistration', component: UserRegistration},
    {path: '/login', name: 'UserLogin', component: UserLogin},
    {path: '/booksLoans', name: 'BookLoans', component: BookLoans, beforeEnter: requireUserRole('user')}, //import {requireUserRole} from "@/api/api"; this is reused
    {path: '/BookManagement', name: 'BookManagement', component: BookManagement, beforeEnter: requireUserRole('admin')},
    {path: '/RegisterUsers', name: 'RegisterUsers', component: RegisterUsers, beforeEnter: requireUserRole('admin')},

]
const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
});
// Navigation guard to check authentication and admin privileges
export default router;
