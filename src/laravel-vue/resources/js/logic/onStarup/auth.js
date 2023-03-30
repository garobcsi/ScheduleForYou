import {useAuthStore} from "../../stores/AuthStore";

export function start() {
    const authStore = useAuthStore();
    const stayLogedIn = JSON.parse(localStorage.getItem('stayLogedIn'));
    if (stayLogedIn === null || !stayLogedIn) {
        authStore.delete();
        return;
    }
    authStore.loadDataIn();
    if (!authStore.isLogedIn) {
        authStore.logoutSession();
    }
}
