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
            path: '/a',
            name: 'about',
            component: () => import('../pages/Home.vue'),
        }
    ]
})

export default router;