import axios from "axios";
import {useAuthStore} from "../stores/AuthStore";

const api = axios.create({
    baseURL: location.protocol+"//"+location.host+"/api",
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'X-API-Key': useAuthStore().token
    }
});

export {api}
