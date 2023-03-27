import { defineStore } from 'pinia'
import {api} from "../utils/api";
export const useAuthStore = defineStore('auth-store', {
    state() {
        return {
            token: null,
            user:null,
            error: null
        }
    },
    actions: {
        async login(values) {
            this.logout();
            let loginData = null;
            let loginError = null;
            await api.post('/login',values).then(x=>loginData =x.data).catch(x=>loginError= x.response.data);
            if (loginData !== null) {
                this.token= loginData.data.token;
                let userData = null;
                let userError = null;
                await api.get('/user').then(x=>userData =x.data).catch(x=>userError= x.response.data);
                if (userData !== null) {
                    this.user = userData.data;
                    this.save();
                }
                else {
                    this.error = userError;
                }
            }
            else {
                this.error = loginError;
            }
        },
        logout() {
            this.token = null;
            this.user = null;
            this.delete();
        },
        save() {
            localStorage.setItem('token',this.token);
            localStorage.setItem('user',JSON.stringify(this.user));
        },
        delete() {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
        },
    },
    getters: {
        isLogedIn() {
            return this.token !== null && this.user !== null;
        },
    },
})
