<template>
    <div class="container-fluid">
        <div class="row">
            <div class="container my-5">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h1 class="display-4 mb-4">{{ $t('index.title.title') }}</h1>
                        <p class="lead">{{ $t('index.title.txt') }}</p>
                    </div>
                </div>

                <div class="row justify-content-center my-5">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h2 class="mb-4">{{ $t('index.feature.title') }}</h2>
                        <div class="row">
                            <div class="col-md-6 d-flex justify-content-center">
                                <ul class="list-unstyled text-center">
                                    <li>{{ $t('index.feature.txt') }}</li>
                                    <li>{{ $t('index.feature.txt1') }}</li>
                                </ul>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center">
                                <ul class="list-unstyled text-center">
                                    <li>{{ $t('index.feature.txt2') }}</li>
                                    <li>{{ $t('index.feature.txt3') }}</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center" v-show="!authStore.isLogedIn">
                    <div class="col-lg-8 col-md-10 text-center">
                        <h2 class="mb-4">{{ $t('index.getStarted.title') }}</h2>
                        <p class="lead mb-5">{{ $t('index.getStarted.txt') }}</p>
                        <router-link to="/register" class="btn btn-primary me-3">{{ $t('index.getStarted.button.register') }}</router-link>
                        <router-link to="/login" class="btn btn-outline-primary">{{ $t('index.getStarted.button.logIn') }}</router-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useAuthStore} from "../stores/AuthStore";

const authStore = useAuthStore();

</script>

<style scoped>

h1.display-4 {
    color: #007bff;
}

ul.list-unstyled {
    text-align: left;
}

.btn-primary {
    background-color: #007bff;
    border-color: #007bff;
}

.btn-primary:hover {
    background-color: #0069d9;
    border-color: #0062cc;
}

.btn-outline-primary {
    color: #007bff;
    border-color: #007bff;
}

.btn-outline-primary:hover {
    color: #fff;
    background-color: #007bff;
    border-color: #007bff;
}
</style>
