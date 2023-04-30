<template>
    <ul class="list-group mt-3" >
        <button class="list-group-item list-group-item-action text-center" v-for="locale in $i18n.availableLocales" :value="locale" @click="setLocal(locale)">{{$t(`locale.${locale}`)}}</button>
    </ul>
</template>

<script setup>
import {useI18n} from "vue-i18n";
import {api} from "../../utils/api";
const { locale } = useI18n({useScope: 'global'})
function setLocal(l){
    locale.value = l;
    localStorage.setItem('locale', locale.value );
    api.post('/user/settings',{lang: l});
}
</script>
