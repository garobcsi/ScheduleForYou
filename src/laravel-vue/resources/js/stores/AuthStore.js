import { defineStore } from 'pinia'
import {api} from "../utils/api";
import {useAlertStore} from "./AlertStore";
import {router} from "../router";
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
        async update() {
            let userData = null;
            await api.get('/user').then(x=>userData =x.data);
            if (userData !== null) {
                this.user = userData.data;
                this.errorMsg = null;
                this.save();
            }
        },
        logoutSession() {
            this.token = null;
            this.user = null;
            this.stayLogedIn = false;
            this.delete();
        },
        async logout(silent = false) {
            let logoutData = null;
            let logoutError= null;
            await api.get('/logout').then(x=>logoutData =x.data).catch(x=>logoutError= x.response.data);
            router.push({name:"index"});
            this.logoutSession();
            if (silent) return;
            if (logoutData !== null) {
                useAlertStore().push('toast.logout.account','success');
            }
            else if (logoutError !== null) {
                useAlertStore().push('toast.error','danger');
            }
        },
        async logoutAll(silent = false) {
            let logoutAllData = null;
            let logoutAllError= null;
            await api.get('/logout/all').then(x=>logoutAllData =x.data).catch(x=>logoutAllError= x.response.data);
            router.push({name:"index"});
            this.logoutSession();
            if (silent) return;
            if (logoutAllData !== null) {
                useAlertStore().push('toast.logout.accountAll','success');
            }
            else if (logoutAllError !== null) {
                useAlertStore().push('toast.error','danger');
            }
        },
        async deleteAccount(silent = false) {
            let accountData = null;
            let accountError= null;
            await api.delete('/user').then(x=>accountData =x.data).catch(x=>accountError= x.response.data);
            router.push({name:"index"});
            this.logoutSession();
            if (silent) return;
            if (accountData !== null) {
                useAlertStore().push('toast.accountDelete.success','success');
            }
            else if (accountError !== null) {
                useAlertStore().push('toast.error','danger');
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
        isAdminLocalStorageOnly() {
            if (this.user === null || this.user === undefined) return false;
            if(this.user.role === "admin") return true;
        },
        async isAdmin() {
            if (this.user === null || this.user === undefined) return false;
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
