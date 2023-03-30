import {useAuthStore} from "../../stores/AuthStore";
import {api} from "../../utils/api";

export async function start() {
    const authStore = useAuthStore();
    const stayLogedIn = JSON.parse(localStorage.getItem('stayLogedIn'));
    if (stayLogedIn === null || !stayLogedIn) {
        authStore.delete();
        return;
    }
    authStore.loadDataIn();
    if (!authStore.isLogedIn) {
        authStore.logoutSession();
        return;
    }
    let isValidData = null;
    let isValidError= null;
    await api.get('/login/valid').then(x=>isValidData =x.data).catch(x=>isValidError= x.response.data);
    if (isValidData !== null && isValidData.message === "Authenticated.") {
        let keepAliveData = null;
        let keepAliveError = null;
        await api.get('/login/alive').then(x=>keepAliveData =x.data).catch(x=>keepAliveError= x.response.data);
        if (keepAliveError !== null) {
            //error
        }
    }
    else if(isValidError !== null){
        //error
        authStore.logoutSession();
    }
}
