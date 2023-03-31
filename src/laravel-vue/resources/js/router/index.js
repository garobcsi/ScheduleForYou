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
        component: () => import('@/pages/LoginPage.vue'),
        meta: {
            accessAfterLogin: false
        }
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/pages/RegisterPage.vue'),
        meta: {
            accessAfterLogin: false
        }
    },
    {
        path: '/homepage',
        name: 'homepage',
        component: () => import('@/pages/HomePage.vue'),
        meta: {
            accessAfterLogin: false
        }
    },
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: import('@/components/error/NotFound.vue') }, // 404 error not found
]

export const router = createRouter({
  history: createWebHashHistory(),
  routes
});
router.beforeEach((to, from, next)=>{
    const authStore= useAuthStore();
    if ((to.meta.accessAfterLogin === false && authStore.isLogedIn) || (to.meta.accessAfterLogin === true && !authStore.isLogedIn)) {
        next({name: 'index'});
    }
    else {
        next();
    }
})
