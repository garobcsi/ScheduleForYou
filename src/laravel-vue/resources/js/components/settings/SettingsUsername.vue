<template>
    <VeeForm @submit="onUsernameSubmit" v-slot="{ values }" :validation-schema="i18nSchema" :initial-values="initialValues">
        <label for="username" class="mt-2">{{t('settings.menu.profile.username')}}</label>
        <div class="hstack gap-2 col-xl-8">
            <Field :disabled="disabled" name="username" id="username" type="text" class="form-control mt-1 d-flex align-self-end " :class="{'is-invalid':!i18nIsValid(values)}" />
            <button type="submit" class="btn btn-outline-success mt-2" :disabled="disabled">{{t('settings.menu.profile.update')}}</button>
        </div>
        <ErrorMessage name="username" id="username" as="div" class="invalid-feedback col-xl-8" />
    </VeeForm>
</template>

<script setup>
import {computed, ref} from "vue";
import * as yup from "yup";
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import {useI18n} from "vue-i18n";
import {api} from "../../utils/api";
import {useAuthStore} from "../../stores/AuthStore";
import {useAlertStore} from "../../stores/AlertStore";
const { t, te } = useI18n();

const dataSuccess = ref(null);
const disabled = ref(true);
(async () => {
    if (useAuthStore().isLogedIn) {
        await api.get('/user').then(x=>dataSuccess.value =x.data);
        disabled.value = false;
    }
})();
const initialValues = computed(()=> {
    return {
        "username": dataSuccess.value !== null ? dataSuccess.value.data.name : `${t('settings.menu.profile.loading')} ...`
    }
})

const i18nSchema = computed(() => {
    return yup.object({
        username: yup.string().min(3,t('settings.menu.profile.validation.min',{n:3})).max(255,t('settings.menu.profile.validation.max',{n:255})).required(t('settings.menu.profile.validation.required')),
    })
});

function i18nIsValid(values) {
    return i18nSchema.value.isValidSync(values);
}

async function onUsernameSubmit(values) {
    let data = null;
    let error = null;
    await api.post('/user',{
        username: values.username
    }).then(x=>data =x.data).catch(x=>error= x.response.data);
    if (data !== null) {
        useAlertStore().push("toast.username.success","success");
        useAuthStore().update();
    };
    if (error !== null) useAlertStore().push("toast.error","danger");
}
</script>

<style scoped>
.invalid-feedback {
    display: unset;
}
</style>
