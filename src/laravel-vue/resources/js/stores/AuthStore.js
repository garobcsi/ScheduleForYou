import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth-store', {
    state() {
        return {
            token: localStorage.getItem('token') !== null ? JSON.parse(localStorage.getItem('token')).data.token : null,
            user: localStorage.getItem('user') !== null ? JSON.parse(localStorage.getItem('user')).data : null,
        }
    },
    actions: {

    },
    getters: {
        isLogedIn() {
            return this.token !== null;
        }
    }
})
