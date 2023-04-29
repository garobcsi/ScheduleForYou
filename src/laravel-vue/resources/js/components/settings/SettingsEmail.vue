<template>
    <VeeForm @submit="onUsernameSubmit" v-slot="{ values }" :validation-schema="i18nSchema" :initial-values="initialValues">
        <label for="email" class="mt-2">{{t('settings.menu.profile.email')}}</label>
        <div class="hstack gap-2 col-xl-8">
            <Field :disabled="disabled" name="email" id="email" type="text" class="form-control mt-1 d-flex align-self-end " :class="{'is-invalid':!i18nIsValid(values)}" />
            <button type="submit" class="btn btn-outline-success mt-2" :disabled="disabled">{{t('settings.menu.profile.update')}}</button>
        </div>
        <ErrorMessage name="email" id="email" as="div" class="invalid-feedback col-xl-8" />
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
import {router} from "../../router";
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
        "email": dataSuccess.value !== null ? dataSuccess.value.data.email : `${t('settings.menu.profile.loading')} ...`
    }
})

const i18nSchema = computed(() => {
    return yup.object({
        email: yup.string().email().max(255).required(),
    })
});

function i18nIsValid(values) {
    return i18nSchema.value.isValidSync(values);
}

async function onUsernameSubmit(values) {
    let data = null;
    let error = null;
    await api.post('/user',{
        email: values.email
    }).then(x=>data =x.data).catch(x=>error= x.response.data);
    if (data !== null) {
        useAlertStore().push("toast.email.success","success");
        useAuthStore().logout(true);
        router.push({name: 'index'});
    }
    if (error === null) return;
    if (error.message === "The email has already been taken.") useAlertStore().push("toast.email.taken","warning");
    else if (error !== null) useAlertStore().push("toast.error","danger");
}
</script>

<style scoped>
.invalid-feedback {
    display: unset;
}
</style>
