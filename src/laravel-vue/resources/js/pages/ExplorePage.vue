<template>
    <div class="container-fluid">
        <div class="row">
            <div class="container py-5">
                <h1 class="mb-4">{{$t('explore.companies')}}</h1>
                <div class="row">
                    <div v-for="(company) in companies" :key="company.id" class="col-md-4">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">{{ company.name }}</h5>
                                <p class="card-text">{{ company.introduce }}</p>
                                <p class="card-text">{{ company.email}}</p>
                                <p class="card-text">{{ company.tel}}</p>
                                <p class="card-text">{{ company.address}}</p>
                                <router-link :to="{path:'/company/' + company.id}" class="btn btn-primary">{{$t('explore.card.show')}}</router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useI18n} from "vue-i18n";
import {api} from "../utils/api";
import {ref} from "vue";

const { t, te } = useI18n();
const companies = ref({});

(async () => {
    await api.get('/company').then(x=>companies.value =x.data.data)
})();

</script>

<style scoped>

</style>
