import {start as authStart} from "./logic/onStarup/auth";
export function onStartup() {
    authStart();
}
