<template>
    <div class="container">
        <div class="row">
            <RouterLink :to="{name: 'login'}" class="btn btn-primary">To Login</RouterLink>
            <RouterLink :to="{name: 'register'}" class="btn btn-primary mt-1">To Registration</RouterLink>
            <button class="btn btn-danger mt-1" @click="authStore.logout()">Logout</button>
            <button class="btn btn-danger mt-1" @click="authStore.logoutAll()">Logout All Devices</button>
            {{authStore.token ?? "no data"}}
            <br>
            {{authStore.user ?? "no data"}}
        </div>
        <button class="btn btn-primary" @click="addAlertT">Add Alert Type 1</button>
        <button class="btn btn-primary" @click="addAlertTT">Add Alert Type 2</button>
        <button class="btn btn-primary" @click="addAlertTTT">Add Alert Type 3</button>
    </div>
</template>

<script setup>
import {useAuthStore} from "../stores/AuthStore";
import {useAlertStore} from "../stores/AlertStore";
const authStore = useAuthStore();
const alertStore = useAlertStore();
function addAlertT() {
    alertStore.push("This is a msg !","warning");
}
function addAlertTT() {
    alertStore.push("TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT ","danger");
}function addAlertTTT() {
    alertStore.push("Alert !","primary");
}
</script>
