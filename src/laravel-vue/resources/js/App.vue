<template>
    <NavBar/>
    <RouterView/>
    <AlertBox/>
</template>

<script setup>
import { RouterView } from 'vue-router';
import NavBar from './components/bootstrap/NavBar.vue';
import AlertBox from "./components/alert/AlertBox.vue";
</script>
