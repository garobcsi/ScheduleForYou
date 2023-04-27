<template>
    <div class="list-group list-group-horizontal align-items-center">
        <div class="btn-group mx-1 dropdown">
            <ion-icon class="text-white" :icon="languageOutline" id="lang"  type="button" data-bs-toggle="dropdown" aria-expanded="false"></ion-icon>
            <ul class="dropdown-menu dropdown-menu-end mt-3" id="lang-dd">
                <li v-for="locale in $i18n.availableLocales">
                    <button class="dropdown-item" @click="setLocal(locale)" :value="locale">{{$t(`locale.${locale}`)}}</button>
                </li>
            </ul>
        </div>
        <div v-show="!authStore.isLogedIn" class="btn-group pe-2 ps-1">
            <router-link class="btn btn-outline-primary" to="/register">Registration</router-link>
        </div>
        <div v-show="!authStore.isLogedIn" class="btn-group p-0">
            <router-link class="btn btn-outline-primary" to="/login">Login</router-link>
        </div>
        <div v-show="authStore.isLogedIn" class="btn-group mx-1">
            <button class="m-0 p-0 border-0 dropdown-item" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <ion-icon class="text-white d-flex" :icon="personCircle" id="profIcon"></ion-icon>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li><router-link class="dropdown-item" to="/profile">Profil</router-link></li>
                <li><hr class="dropdown-divider"></li>
                <li><button class="dropdown-item" @click="authStore.logout">Kijelentkezés</button></li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import {useAuthStore} from "../../stores/AuthStore";
const authStore = useAuthStore();
import { IonIcon } from '@ionic/vue';
import { personCircle } from 'ionicons/icons';
import { languageOutline } from 'ionicons/icons';

import {useI18n} from "vue-i18n";
const { locale } = useI18n({useScope: 'global'})
function  setLocal(l){
    locale.value = l;
    localStorage.setItem('local', locale.value );
}

</script>

<style scoped>
#profIcon{
    font-size: 50px;
}
#lang{
    font-size: 25px;
}
#lang-dd{
    margin-right: -60px;
}
</style>
