import { defineStore } from 'pinia'
import {api} from "../utils/api";
import {useAlertStore} from "./AlertStore";
export const useAuthStore = defineStore('auth-store', {
    state() {
        return {
            token: null,
            user:null,
            stayLogedIn: false,
            errorMsg: null
        }
    },
    actions: {
        async login(values) {
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
                    this.errorMsg = null;
                    this.save();
                }
                else {
                    this.errorMsg = userError;
                }
            }
            else {
                this.errorMsg = loginError;
            }
        },
        logoutSession() {
            this.token = null;
            this.user = null;
            this.stayLogedIn = false;
            this.delete();
        },
        async logout() {
            let logoutData = null;
            let logoutError= null;
            await api.get('/logout').then(x=>logoutData =x.data).catch(x=>logoutError= x.response.data);
            this.logoutSession();
            if (logoutData !== null) {
                useAlertStore().push('Sikeres kijelentkezés !','success');
            }
            else if (logoutError !== null) {
                useAlertStore().push('Váratlan hiba történt !','danger');
            }
        },
        async logoutAll() {
            let logoutAllData = null;
            let logoutAllError= null;
            await api.get('/logout/all').then(x=>logoutAllData =x.data).catch(x=>logoutAllError= x.response.data);
            this.logoutSession();
            if (logoutAllData !== null) {
                useAlertStore().push('Sikeres kijelentkezés összes fiókból !','success');
            }
            else if (logoutAllError !== null) {
                useAlertStore().push('Váratlan hiba történt !','danger');
            }
        },
        save() {
            localStorage.setItem('token',this.token);
            localStorage.setItem('user',JSON.stringify(this.user));
            localStorage.setItem('stayLogedIn',this.stayLogedIn);
        },
        delete() {
            localStorage.removeItem('token');
            localStorage.removeItem('user');
            localStorage.removeItem('stayLogedIn');
        },
        loadDataIn() {
            this.token = localStorage.getItem('token');
            this.user = JSON.parse(localStorage.getItem('user'));
            this.stayLogedIn = JSON.parse(localStorage.getItem('stayLogedIn'));
        }
    },
    getters: {
        isLogedIn() {
            return this.token !== null && this.user !== null;
        },
        async isAdmin() {
            if (this.user === null || this.user === undefined) return null;
            if(this.user.role !== "admin") return false;
            let success = null;
            let error = null;
            await api.get('/user').then(x=>success =x.data).catch(x=>error= x.response.data);
            if (success.data.role === "admin") return true;
            return false;

        },
        gotErrors() {
            return this.errorMsg !== null;
        }
    },
})
