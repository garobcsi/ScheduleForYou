import axios from "axios";
const api = axios.create({
    baseURL: location.protocol+"//"+location.host+"/api",
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': "Bearer "+"TOKEN"
    }
});

export {api}
