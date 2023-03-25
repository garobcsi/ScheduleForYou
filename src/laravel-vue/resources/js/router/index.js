import {createRouter, createWebHashHistory} from 'vue-router';

const routes = [
    {
        path: '/',
        name: 'index',
        component: () => import('@/pages/IndexPage.vue'),
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('@/pages/LoginPage.vue')
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/pages/RegisterPage.vue')
    }
]

export const router = createRouter({
  history: createWebHashHistory(),
  routes
});
