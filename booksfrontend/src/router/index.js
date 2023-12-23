
import { createRouter, createWebHistory } from 'vue-router'
import UserRegistration from "@/components/UserRegistration.vue";
import HelloWorld from "@/components/HelloWorld.vue";


const routes = [
    {
        path: '/',
        name: 'HelloWorld',
        component: HelloWorld
    },
    {
        path: '/Registration',
        name: ' UserRegistration',
        component:  UserRegistration
    }
]
const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})
export default router
