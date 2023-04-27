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
            <router-link class="btn btn-outline-primary" to="/register">{{$t('navbar.button.register')}}</router-link>
        </div>
        <div v-show="!authStore.isLogedIn" class="btn-group p-0">
            <router-link class="btn btn-outline-primary" to="/login">{{$t('navbar.button.login')}}</router-link>
        </div>
        <div v-show="authStore.isLogedIn" class="btn-group mx-1">
            <button class="m-0 p-0 border-0 dropdown-item" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <ion-icon class="text-white d-flex" :icon="personCircle" id="profIcon"></ion-icon>
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
                <li>
                    <router-link class="dropdown-item d-flex align-items-center" to="/profile">
                        <span class="panel-heading">{{ $t('navbar.dropdown.logedInAs') }} <span class="fw-semibold">{{authStore.user !== null ? authStore.user.name : "User"}}</span></span>
                    </router-link>
                </li>
                <li><hr class="dropdown-divider"></li>
                <div v-show="authStore.isAdminLocalStorageOnly === true">
                    <li>
                        <router-link class="dropdown-item d-flex align-items-center" to="/admin">
                            <ion-icon class="me-1 icons" :icon="terminalOutline"></ion-icon>
                            {{ $t('navbar.dropdown.adminPage') }}
                        </router-link>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                </div>
                <li>
                    <router-link class="dropdown-item d-flex align-items-center" to="/profile">
                        <ion-icon class="me-1 icons" :icon="personOutline"></ion-icon>
                        {{ $t('navbar.dropdown.profile') }}
                    </router-link>
                </li>
                <li>
                    <router-link class="dropdown-item d-flex align-items-center" to="/company">
                        <ion-icon class="me-1 icons" :icon="businessOutline"></ion-icon>
                        {{ $t('navbar.dropdown.companies') }}
                    </router-link>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <router-link class="dropdown-item d-flex align-items-center" :to="{name:'settings'}">
                        <ion-icon class="me-1 icons" :icon="settingsOutline"></ion-icon>
                        {{ $t('navbar.dropdown.settings') }}
                    </router-link>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <button class="dropdown-item d-flex align-items-center" @click="authStore.logout">
                        <ion-icon class="me-1 icons" :icon="logOutOutline"></ion-icon>
                        {{ $t('navbar.dropdown.logOut') }}
                    </button>
                </li>
            </ul>
        </div>
    </div>
</template>

<script setup>
import {useAuthStore} from "../../stores/AuthStore";
const authStore = useAuthStore();
import { IonIcon } from '@ionic/vue';
import { personCircle, languageOutline,logOutOutline,settingsOutline,personOutline,businessOutline,terminalOutline } from 'ionicons/icons';

import {useI18n} from "vue-i18n";
const { locale } = useI18n({useScope: 'global'})
function  setLocal(l){
    locale.value = l;
    localStorage.setItem('local', locale.value );
}
</script>

<style scoped>
.icons {
    font-size: 22px;
}
#profIcon{
    font-size: 50px;
}
#lang{
    font-size: 25px;
}
#lang-dd{
    margin-right: -60px;
}
.panel-heading{
    display: inline-block;
    max-width: 150px;
    white-space: pre-wrap;
    overflow: hidden !important;
    text-overflow: ellipsis;
}
</style>
