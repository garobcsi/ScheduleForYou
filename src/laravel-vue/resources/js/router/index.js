import {createRouter, createWebHashHistory} from 'vue-router';

const routes = [
  {
    path: '/',
    name: 'index',
    component: () => import('@/pages/IndexPage.vue')
  }
]

export const router = createRouter({
  history: createWebHashHistory(),
  routes
});
