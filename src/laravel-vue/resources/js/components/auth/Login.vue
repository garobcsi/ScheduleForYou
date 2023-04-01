<script setup>
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import {ref} from "vue";
import {useAuthStore} from "../../stores/AuthStore";
import {useAlertStore} from "../../stores/AlertStore";
import {router} from "../../router";

const authStore = useAuthStore();
const alertStore = useAlertStore();
const alert_danger = ref(null);
const schema = yup.object({
    email:
        yup.string()
            .email('Ez nem email !')
            .required('Kötelező kitölteni !'),
    password:
        yup.string()
            .required('Kötelező kitölteni !'),
})
async function onSubmit(values) {
    if (authStore.isLogedIn) {
        alert_danger.value = "Már bevagy jelentkezve !";
        return;
    }
    authStore.stayLogedIn = values.stayLogedIn === true;
    delete values.stayLogedIn;
    await authStore.login(values);
    if (authStore.isLogedIn && !authStore.gotErrors) {
        alert_danger.value = null;
        router.push({name: 'index'});
        alertStore.push('Sikeres bejelentkezés !','success');
    }
    else if (authStore.errorMsg.message === "Login Unsuccessful.") {
        alert_danger.value = "A felhasználónév vagy jelszó rossz !"
    }
    else {
        alertStore.push('Váratlan hiba történt !','danger');
    }
}
function onChange() {
    alert_danger.value = null;
}
</script>
<template>
    <VeeForm @submit="onSubmit" @change="onChange" v-slot="{ values }" :validation-schema="schema">
        <div v-if="alert_danger !== null" class="alert alert-danger mb-0" role="alert">
            {{alert_danger}}
        </div>
        <label for="email" class="mt-2">Email</label>
        <Field name="email" id="email" type="text" class="form-control mt-1" />
        <ErrorMessage name="email" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="password" class="mt-2">Jelszó</label>
        <Field name="password" id="password" type="password" class="form-control mt-1" />
        <ErrorMessage name="password" as="div" class="alert alert-danger mt-2 mb-0" />
        <div class="form-check mt-2">
            <Field name="stayLogedIn" type="checkbox" :value="true" class="form-check-input"/>
            <label class="form-check-label" for="stayLogedIn">
                Bejelentkezve maradok.
            </label>
        </div>
        <button type="submit" class="btn btn-success mt-2">Bejelentkezés</button>
    </VeeForm>
</template>
