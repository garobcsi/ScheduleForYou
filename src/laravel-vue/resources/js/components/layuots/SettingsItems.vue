<template>
    <div class="
       col-12
    col-sm-12
     col-md-4
     col-xl-4
    col-xxl-4">
        <router-link :to="{name: 'settings_profile'}" class="btn rounded-3 w-100 hover mt-2 text-start d-flex align-items-center" :class="{'on fw-semibold':['settings_profile','settings'].includes($route.name)}"><IonIcon class="icons me-1" :icon="personOutline"/>{{$t('settings.menu.yourProfile')}}</router-link>
        <router-link :to="{name: 'settings_account'}" class="btn rounded-3 w-100 hover mt-1 text-start d-flex align-items-center" :class="{'on fw-semibold':['settings_account'].includes($route.name)}"><IonIcon class="icons me-1" :icon="settingsOutline" />{{$t('settings.menu.yourAccount')}}</router-link>
        <router-link :to="{name: 'settings_language'}" class="btn rounded-3 w-100 hover mt-1 text-start d-flex align-items-center" :class="{'on fw-semibold':['settings_language'].includes($route.name)}"><IonIcon class="icons me-1" :icon="languageOutline" />{{$t('settings.menu.language')}}</router-link>
    </div>
    <div class="
       col-12
    col-sm-12
     col-md-8
     col-xl-8
    col-xxl-8">
        <slot></slot>
    </div>

</template>

<script setup>
import { IonIcon } from '@ionic/vue';
import { personOutline,settingsOutline,languageOutline } from 'ionicons/icons';
</script>

<style>
.on {
    background-color: #CED5DC;

}
.on:hover {
    background-color: #E7ECF0;
}
.hover:hover {
    background-color: #E7ECF0;
}
.icons {
    font-size: 22px;
}
</style>
