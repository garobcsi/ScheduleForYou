<template>
    <h6>{{$t('settings.menu.password.title')}}</h6>
    <VeeForm class="col-xl-8 mb-3" @submit="onUsernameSubmit" v-slot="{ values }" :validation-schema="i18nSchema" @change="onChange">
        <div v-if="alert_danger !== null" class="alert alert-danger mb-0" role="alert">
            {{$t(alert_danger)}}
        </div>
        <label for="password" class="mt-2">{{$t('settings.menu.password.current_password')}}</label>
        <Field name="password" id="password" type="text" class="form-control mt-1 " />
        <ErrorMessage name="password" as="div" class="alert alert-danger mt-2 mb-0" />

        <label for="password_changed" class="mt-2">{{$t('settings.menu.password.password_changed')}}</label>
        <Field name="password_changed" id="password_changed" type="text" class="form-control mt-1 " />
        <ErrorMessage name="password_changed" as="div" class="alert alert-danger mt-2 mb-0" />

        <label for="password_changed_confirm" class="mt-2">{{$t('settings.menu.password.password_changed_confirm')}}</label>
        <Field name="password_changed_confirm" id="password_changed_confirm" type="text" class="form-control mt-1 " />
        <ErrorMessage name="password_changed_confirm" as="div" class="alert alert-danger mt-2 mb-0" />

        <button type="submit" class="btn btn-outline-success mt-2">{{$t('settings.menu.password.update')}}</button>
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

const alert_danger = ref(null);

const i18nSchema = computed(() => {
    return yup.object({
        password: yup.string().min(8,t('settings.menu.password.validation.min',{n:8})).max(255,t('settings.menu.password.validation.max',{n:255})).required(t('settings.menu.password.validation.required')),
        password_changed: yup.string().min(8,t('settings.menu.password.validation.min',{n:8})).max(255,t('settings.menu.password.validation.max',{n:255})).required(t('settings.menu.password.validation.required')).notOneOf([yup.ref('password')],t('settings.menu.password.validation.oldPasswordAndNewPasswordSame')),
        password_changed_confirm: yup.string().min(8,t('settings.menu.password.validation.min',{n:8})).max(255,t('settings.menu.password.validation.max',{n:255})).required(t('settings.menu.password.validation.required')).oneOf([yup.ref('password_changed')],t('settings.menu.password.validation.passwordAreNotTheSame')),
    })
});

async function onUsernameSubmit(values) {
    delete values.password_changed_confirm;
    let data = null;
    let error = null;
    await api.post('/user/password',values).then(x=>data =x.data).catch(x=>error= x.response.data);

    if (data !== null) {
        useAlertStore().push('toast.password.success',"success");
        await useAuthStore().logoutAll(true);
    }
    else if (error !== null) {
        if (error.message === "Wrong password !") alert_danger.value = "toast.password.wrongPassword";
        else useAlertStore().push('toast.error',"danger");
    }
}
function onChange() {
    alert_danger.value = null;
}
</script>

<style scoped>
</style>
