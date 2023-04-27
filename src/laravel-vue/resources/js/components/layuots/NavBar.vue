<template>
    <nav class="navbar navbar-expand-lg navbar-dark shadow-sm bg-dark">
        <div class="container-fluid d-flex justify-content-between">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#Toggler" aria-controls="Toggler" aria-expanded="false">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="/">Navbar</a>
            <LangUser class="navbar-brand navbar-toggler navbar-remove">NavBar 2</LangUser>
            <div class="collapse navbar-collapse" id="Toggler">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled">Disabled</a>
                    </li>
                </ul>
            </div>
            <LangUser class="collapse navbar-collapse justify-content-end">Navbar 2</LangUser>
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
