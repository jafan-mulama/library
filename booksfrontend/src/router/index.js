
import { createRouter, createWebHistory } from 'vue-router'
import UserRegistration from "@/components/UserRegistration.vue";
import HelloWorld from "@/components/HelloWorld.vue";
import UserLogin from "@/components/UserLogin.vue";
import BookLoans from "@/components/BookLoans.vue";


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
        path: '/loans',
        name: 'BookLoans',
        component:  BookLoans
    }
]
const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})
export default router
