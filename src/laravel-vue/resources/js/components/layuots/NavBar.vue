<template>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm bg-dark">
        <div class="container-fluid d-flex justify-content-between">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Toggler" aria-controls="Toggler" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <router-link class="navbar-brand" to="/">
                ScheduleForYou
            </router-link>
            <LangUser class="navbar-brand navbar-toggler navbar-remove"></LangUser>
            <div class="collapse navbar-collapse" id="Toggler">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'explore'}">{{$t('navbar.explore')}}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'services'}">{{$t('navbar.services')}}</router-link>
                    </li>
                </ul>
            </div>
            <LangUser class="collapse navbar-collapse justify-content-end"></LangUser>
        </div>
    </nav>
</template>

<script setup>
import LangUser from "../navbar/LangUser.vue";
</script>

<style scoped>

.navbar-remove {
    margin: 0;
    padding: 0;
    border: none;
    font: revert;
    color: revert;
    text-decoration: revert;
}
</style>
