<script setup>
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import {api} from "../../utils/api";
import {ref} from "vue";
import {router} from "../../router";
import {useAlertStore} from "../../stores/AlertStore";

const alertStore = useAlertStore();
const alert_danger = ref(null);
const schema = yup.object({
    name:
        yup.string()
            .min(3,'Minimum 3 betűnél nagyobb legyen.')
            .max(255,'Maxinum 255 karakter hosszú lehet.')
            .required('Kötelező kitölteni !'),
    email:
        yup.string()
            .email('Ez nem email !')
            .max(255,'Maxinum 255 karakter hosszú lehet.')
            .required('Kötelező kitölteni !'),
    password:
        yup.string()
            .min(8,'A jelszó 8 betünél kisebb nem lehet !')
            .max(255,'Maxinum 255 karakter hosszú lehet.')
            .required('Kötelező kitölteni !')
            .notOneOf([yup.ref('name')], 'A jelszó és felhazsnálónév nem lehet ugyan az !'),
    password_confirm:
        yup.string()
            .required('Kötelező kitölteni !')
            .oneOf([yup.ref('password')], 'A jelszavak nem egyeznek meg !')
})
async function onSubmit(values) {
    delete values.password_confirm;
    let data = null;
    let error = null;
    await api.post('/register',values).then(x=>data =x.data).catch(x=>error= x.response.data);
    showAlert(data,error);
}
function onChange() {
    alert_danger.value = null;
}
function showAlert(data,error) {
    if (data !== null) {
        if (data.message === "Registration Success.") {
            alert_danger.value = null;
            router.push({name: 'index'});
            alertStore.push('Sikeres regisztráció !','success');
        }
    }
    if (error !== null) {
        if (error.message === "The email has already been taken.") {
            alert_danger.value = "Ez az email már foglalva van !";
        }
        else {
            alertStore.push('Váratlan hiba történt !','danger');
        }
    }
}
</script>

<template>
    <VeeForm @submit="onSubmit" v-slot="{ values }" :validation-schema="schema" @change="onChange">
        <div v-if="alert_danger !== null" class="alert alert-danger mb-0" role="alert">
            {{alert_danger}}
        </div>
        <label for="name" class="mt-2">Felhasználónév</label>
        <Field name="name" id="name" type="text" class="form-control mt-1" />
        <ErrorMessage name="name" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="email" class="mt-2">Email</label>
        <Field name="email" id="email" type="text" class="form-control mt-1" />
        <ErrorMessage name="email" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="password" class="mt-2">Jelszó</label>
        <Field name="password" id="password" type="password" class="form-control mt-1" />
        <ErrorMessage name="password" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="password_confirm" class="mt-2">Jelszó Megerősítés</label>
        <Field name="password_confirm" id="password_confirm" type="password" class="form-control mt-1" />
        <ErrorMessage name="password_confirm" as="div" class="alert alert-danger mt-2 mb-0" />
        <button type="submit" class="btn btn-success mt-2">Regisztráció</button>
    </VeeForm>
</template>
