import {createRouter, createWebHistory} from 'vue-router';
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
        beforeEnter: [dontAccessAfterLogin]
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/pages/RegisterPage.vue'),
        beforeEnter: [dontAccessAfterLogin]
    },
    {
        path: '/home',
        name: 'home',
        component: () => import('@/pages/HomePage.vue')
    },
    {
        path: '/naptar',
        name: 'naptar',
        component: () => import('@/pages/CalendarPage.vue'),
    },
    {
        path: '/profile',
        name: 'profile',
        component: () => import('@/pages/ProfilePage.vue')
    },
    { path: '/:pathMatch(.*)*', name: 'NotFound', component: () => import('@/components/error/NotFound.vue') }, // 404 error not found
    // admin
    {
        path: '/admin',
        name: 'admin_index',
        component: () => import('@/pages/Admin/AdminIndexPage.vue'),
        beforeEnter: [onlyAdminAccess]
    },
    {
        path: '/admin/login_registration_test',
        name: 'admin_login_registration_test',
        component: () => import('@/pages/Admin/LoginRegistrationTestPage.vue'),
        beforeEnter: [onlyAdminAccess]
    },
    {
        path: '/admin/toast_test',
        name: 'admin_toast_test',
        component: () => import('@/pages/Admin/ToastTestPage.vue'),
        beforeEnter: [onlyAdminAccess]
    }
    // admin end
]

export const router = createRouter({
  history: createWebHistory(),
  routes
});
function accessAfterLogin(to, from, next) {
    const authStore= useAuthStore();
    if (authStore.isLogedIn === true) {
        next();
    }
    else {
        next({name: 'index'});
    }
}
function dontAccessAfterLogin(to, from, next) {
    const authStore= useAuthStore();
    if (authStore.isLogedIn === true) {
        next({name: 'index'});
    }
    else {
        next();
    }
}
async function onlyAdminAccess(to, from, next) {
    const authStore= useAuthStore();
    let isAdmin = null;
    await authStore.isAdmin.then(x=>isAdmin = x);
    if (isAdmin === true) {
        next();
    }
    else {
        next({name: 'index'});
    }
}
