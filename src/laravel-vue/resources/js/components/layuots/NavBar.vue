<template>
    <nav class="navbar navbar-expand-md bg-light">
        <div class="container-fluid basic-margo">
            <a class="navbar-brand" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <router-link class="nav-link" to="/homepage">{{ $t('navbar.home') }}</router-link>
                    </li>
                    <li class="nav-item">
                        <router-link class="nav-link" to="/">{{ $t('navbar.services') }}</router-link>
                    </li>

                </ul>
                <div class="btn-group mx-2 wh-3">
                    <button class="btn btn-secondary rounded-5 np nb wh-3 d-flex align-items-center" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <ion-icon :icon="personCircleOutline" id="icon"></ion-icon>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li ><router-link class="dropdown-item" to="#">Profil</router-link></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><router-link class="dropdown-item" to="#">Kijelentkezés</router-link></li>
                        <li><router-link class="dropdown-item" to="/login">Bejelentkezés</router-link></li>
                        <li><router-link class="dropdown-item" to="/register">Regisztrálás</router-link></li>
                        <li><router-link class="dropdown-item" to="#">Kijelentkezés</router-link></li>
                        <div class="mx-2">
                            <select v-model="$i18n.locale" @change="onChange($i18n.locale)" class="form-select">
                                <option v-for="locale in $i18n.availableLocales" :value="locale">{{locale}}</option>
                            </select>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { IonIcon } from '@ionic/vue';
import { personCircleOutline } from 'ionicons/icons';
</script>

<style scoped>
#icon{
    font-size: 48px
}
.np{
    padding: 0;
}
nb{
    border: none;
}
wh-3{
    width: 3rem;
    height: 3rem
}
bg-transparent{
    background-color: rgba(0,0,0,0%);
}
</style>
