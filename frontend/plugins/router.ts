import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory('/app'),
    routes: [
        {
            path: '/',
            name: 'home',
            component: () => import('../pages/Home.vue'),
            meta: {
                layout: 'auth-layout'
            }
        },
        {
            path: '/sign-up',
            name: 'auth.sign-up',
            component: () => import('../pages/Auth/SignUp.vue'),
            meta: {
                layout: 'guest-layout'
            }
        }
    ]
})

export default router;