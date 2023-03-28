<script setup>
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import {ref} from "vue";
import {useAuthStore} from "../../stores/AuthStore";
const authStore = useAuthStore();
const alert_success = ref(null);
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
     await authStore.login(values);
     console.log(authStore.errorMsg);
     if (authStore.isLogedIn && !authStore.gotErrors) {
         alert_danger.value = null;
         alert_success.value = "Sikeres bejelentkezés";
     }
     else if (authStore.errorMsg.message === "Login Unsuccessful.") {
        alert_success.value = null;
        alert_danger.value = "A felhasználónév vagy jelszó rossz !"
     }
     else {
         alert_success.value = null;
         alert_danger.value = "Váratlan hiba történt !"
     }
}
function onChange() {
    alert_success.value = null;
    alert_danger.value = null;
}
</script>
<template>
    <VeeForm @submit="onSubmit" @change="onChange" v-slot="{ values }" :validation-schema="schema">
        <div v-if="alert_success !== null" class="alert alert-success mb-0" role="alert">
            {{alert_success}}
        </div>
        <div v-if="alert_danger !== null" class="alert alert-danger mb-0" role="alert">
            {{alert_danger}}
        </div>
        <label for="email" class="mt-2">Email</label>
        <Field name="email" id="email" type="text" class="form-control mt-1" />
        <ErrorMessage name="email" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="password" class="mt-2">Jelszó</label>
        <Field name="password" id="password" type="password" class="form-control mt-1" />
        <ErrorMessage name="password" as="div" class="alert alert-danger mt-2 mb-0" />
        <button type="submit" class="btn btn-success mt-2">Bejelentkezés</button>
    </VeeForm>
</template>
