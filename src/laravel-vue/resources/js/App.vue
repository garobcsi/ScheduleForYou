<template>
    <NavBar/>
    <RouterView/>
    <AlertBox/>
</template>

<script setup>
import { RouterView } from 'vue-router';
import NavBar from './components/layuots/NavBar.vue';
import AlertBox from "./components/alert/AlertBox.vue";
</script>
