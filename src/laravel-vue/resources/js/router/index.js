import {createRouter, createWebHistory} from 'vue-router';
import {useAuthStore} from "../stores/AuthStore";
const routes = [
    {
        path: '/',
        name: 'index',
        component: () => import('@/pages/IndexPage.vue'),
    },
    {
        path: '/services',
        name: 'services',
        component: () => import('@/pages/ServicesPage.vue')
    },
    {
        path: '/explore',
        name: 'explore',
        component: () => import('@/pages/ExplorePage.vue')
    },
    {
        path: '/login',
        name: 'login',
        component: () => import('@/pages/auth/LoginPage.vue'),
        beforeEnter: [dontAccessAfterLogin]
    },
    {
        path: '/register',
        name: 'register',
        component: () => import('@/pages/auth/RegisterPage.vue'),
        beforeEnter: [dontAccessAfterLogin]
    },
    {
        path: '/naptar',
        name: 'naptar',
        component: () => import('@/pages/user/UserCalendarPage.vue'),
        beforeEnter: [accessAfterLogin]

    },
    {
        path: '/profile',
        name: 'profile',
        component: () => import('@/pages/user/ProfilePage.vue'),
        beforeEnter: [accessAfterLogin]

    },
    {
        path: '/company',
        name: 'company',
        component: () => import('@/pages/user/CompanyPage.vue'),
        beforeEnter: [accessAfterLogin]

    },
    {
        path: '/settings',
        name: 'settings',
        component: () => import('@/pages/settings/SettingsProfilePage.vue'),
        beforeEnter: [accessAfterLogin]

    },
    {
        path: '/settings/profile',
        name: 'settings_profile',
        component: () => import('@/pages/settings/SettingsProfilePage.vue'),
        beforeEnter: [accessAfterLogin]

    },
    {
        path: '/settings/account',
        name: 'settings_account',
        component: () => import('@/pages/settings/SettingsAccountPage.vue'),
        beforeEnter: [accessAfterLogin]

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
