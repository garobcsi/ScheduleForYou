import {createRouter, createWebHashHistory} from 'vue-router';
import {useAuthStore} from "../stores/AuthStore";

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

router.beforeEach((to, from, next)=>{
    if ((to.name === "login" || to.name === "register") && useAuthStore().isLogedIn) {
        next({name: 'index'});
    }
    else {
        next();
    }
})
