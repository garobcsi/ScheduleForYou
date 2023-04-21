<template>
    <nav class="navbar navbar-expand-sm bg-light">
        <div class="container-fluid basic-margo">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand" href="#">Navbar</a>
                <ul class="navbar-nav me-auto mb-2 mb-sm-0">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/homepage">{{ $t('navbar.home') }}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">{{ $t('navbar.services') }}</router-link>
                    </li>
                </ul>
            </div>
            <div class="row align-items-center">
                <div class="btn-group col align-items-center dropdown">
                    <ion-icon :icon="languageOutline" id="lang"  type="button" data-bs-toggle="dropdown" aria-expanded="false"></ion-icon>
                    <ul class="dropdown-menu dropdown-menu-end mt-3" id="lang-dd">
                        <li v-for="locale in $i18n.availableLocales">
                            <button class="dropdown-item" @click="setLocal(locale)" :value="locale">{{$t(`locale.${locale}`)}}</button>
                        </li>
                    </ul>
                </div>
                <div class="col mx-1">
                    <button class="btn-group m-0 p-0 border-0 dropdown-item" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <ion-icon :icon="personCircle" id="profIcon"></ion-icon>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end mx-sm-2">
                        <li ><router-link class="dropdown-item" to="#">Profil</router-link></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><router-link class="dropdown-item" to="#">Kijelentkezés</router-link></li>
                        <li><router-link class="dropdown-item" to="/login">Bejelentkezés</router-link></li>
                        <li><router-link class="dropdown-item" to="/register">Regisztrálás</router-link></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { IonIcon } from '@ionic/vue';
import { personCircle } from 'ionicons/icons';
import { languageOutline } from 'ionicons/icons';
import {useI18n} from "vue-i18n";
const { locale } = useI18n({useScope: 'global'})
 function  setLocal(l){
    locale.value = l;
    localStorage.setItem('local', locale );
}

</script>

<style scoped>
#profIcon{
    font-size: 50px
}
#lang{
    font-size: 25px;
    margin-right: -20px;
}
#lang-dd{
    margin-right: -80px;

}

</style>
