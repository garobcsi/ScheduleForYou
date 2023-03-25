<script setup>
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
const schema = yup.object({
    email:
        yup.string()
            .email('Ez nem email !')
            .required('Kötelező kitölteni !'),
    password:
        yup.string()
            .required('Kötelező kitölteni !'),
})
function onSubmit(values) {
    console.log(values);
}
</script>

<template>
    <VeeForm @submit="onSubmit" v-slot="{ values }" :validation-schema="schema">
        <label for="email" class="mt-2">Email</label>
        <Field name="email" id="email" type="text" class="form-control mt-1" />
        <ErrorMessage name="email" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="password" class="mt-2">Jelszó</label>
        <Field name="password" id="password" type="password" class="form-control mt-1" />
        <ErrorMessage name="password" as="div" class="alert alert-danger mt-2 mb-0" />
        <button type="submit" class="btn btn-success mt-2">Bejelentkezés</button>
    </VeeForm>
</template>
