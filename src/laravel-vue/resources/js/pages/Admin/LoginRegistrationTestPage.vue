<template>
    <div class="container mt-2">
        <div class="row">
            <RouterLink :to="{name: 'login'}" class="btn btn-primary">To Login</RouterLink>
            <RouterLink :to="{name: 'register'}" class="btn btn-primary mt-1">To Registration</RouterLink>
            <button class="btn btn-danger mt-1" @click="authStore.logout()">Logout</button>
            <button class="btn btn-danger mt-1" @click="authStore.logoutAll()">Logout All Devices</button>
            {{authStore.token ?? "no data"}}
            <br>
            {{authStore.user ?? "no data"}}
        </div>
    </div>
</template>

<script setup>
import {useAuthStore} from "../../stores/AuthStore";
const authStore = useAuthStore();
</script>
