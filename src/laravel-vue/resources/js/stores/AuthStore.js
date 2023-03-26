import { defineStore } from 'pinia'
import {computed} from "vue";
export const useAuthStore = defineStore('auth-store', () => {
    const token = computed(() => {
        return localStorage.getItem('token') !== null ? JSON.parse(localStorage.getItem('token')).data.token : null;
    })
    const user = computed(()=> {
        return token.value !== null && localStorage.getItem('user') !== null ? JSON.parse(localStorage.getItem('user')).data : null;
    })
    const isLogedIn = computed(()=> {
        return token.value !==null;
    })
    return {token,user,isLogedIn};
})
