<script setup>
import Register from "../components/auth/Register.vue";
</script>

<template>
    <div class="container">
        <div class="row">
            <h1 class="text-center mt-1">{{$t('register.title')}}</h1>
            <Register></Register>
        </div>
    </div>
</template>

<style scoped>

</style>
