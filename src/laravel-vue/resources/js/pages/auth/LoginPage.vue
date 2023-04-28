<script setup>
import Login from "../../components/auth/Login.vue";
</script>

<template>
    <div class="container">
        <div class="row">
            <h1 class="text-center mt-2">{{$t('login.title')}}</h1>
            <Login></Login>
        </div>
    </div>
</template>

<style scoped>

</style>
