<script setup>
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import {api} from "../../utils/api";
import {computed, onMounted, ref, watch} from "vue";
import {router} from "../../router";
import {useAlertStore} from "../../stores/AlertStore";
import { IonIcon } from '@ionic/vue';
import { eyeOutline,eyeOffOutline } from 'ionicons/icons';

import { useI18n } from 'vue-i18n';
const { t, te } = useI18n();

const alertStore = useAlertStore();
const emailExistsAlert = ref(false);
const i18nSchema = computed(() => {
    return yup.object({
        name:
            yup.string()
                .min(3,t('register.form.validation.min',{n:3}))
                .max(255,t('register.form.validation.max',{n:255}))
                .required(t('register.form.validation.required')),
        email:
            yup.string()
                .email(t('register.form.validation.email'))
                .max(255,t('register.form.validation.max',{n:255}))
                .required(t('register.form.validation.required')),
        password:
            yup.string()
                .min(8,t('register.form.validation.password',{n:8}))
                .max(255,t('register.form.validation.max',{n:255}))
                .required(t('register.form.validation.required'))
                .notOneOf([yup.ref('name')], t('register.form.validation.passwordAndUsernameSame')),
        password_confirm:
            yup.string()
                .required(t('register.form.validation.required'))
                .oneOf([yup.ref('password')], t('register.form.validation.passwordAreNotTheSame'))
    })
})
async function onSubmit(values) {
    delete values.password_confirm;
    let data = null;
    let error = null;
    await api.post('/register',values).then(x=>data =x.data).catch(x=>error= x.response.data);
    showAlert(data,error);
}
function onChange() {
    emailExistsAlert.value = false;
}
function showAlert(data,error) {
    if (data !== null) {
        if (data.message === "Registration Success.") {
            emailExistsAlert.value = false;
            router.push({name: 'index'});
            alertStore.push('toast.register.success','success');
        }
    }
    if (error !== null) {
        if (error.message === "The email has already been taken.") {
            emailExistsAlert.value = true;
        }
        else {
            alertStore.push('toast.error','danger');
        }
    }
}
</script>
<script>
export default {
    data() {
        return {
            passwordVisibility: "password",
            passwordConfirmVisibility: "password",
        }
    },
    methods: {
        changePasswordVisibility() {
            this.passwordVisibility = this.passwordVisibility === "password" ? 'text':'password'
        },
        changePasswordConfirmVisibility() {
            this.passwordConfirmVisibility = this.passwordConfirmVisibility === "password" ? 'text':'password'
        },
    },
    computed: {
        isPasswordVisible() {
            return this.passwordVisibility === 'text';
        },
        isPasswordConfirmVisible() {
            return this.passwordConfirmVisibility === 'text';
        }
    }
}
</script>

<template>
    <VeeForm @submit="onSubmit" v-slot="{ values }" :validation-schema="i18nSchema" @change="onChange">
        <div v-if="emailExistsAlert === true" class="alert alert-danger mb-0" role="alert">
            {{t('register.form.error.thisEmailExists')}}
        </div>
        <label for="name" class="mt-2">{{t('register.form.username')}}</label>
        <Field name="name" id="name" type="text" class="form-control mt-1" />
        <ErrorMessage name="name" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="email" class="mt-2">{{t('register.form.email')}}</label>
        <Field name="email" id="email" type="text" class="form-control mt-1" />
        <ErrorMessage name="email" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="password" class="mt-2">{{t('register.form.password')}}</label>
        <div class="input-group">
            <Field name="password" id="password" :type="passwordVisibility" class="form-control mt-1" />
            <button type="button" class="btn mt-1 btn-outline-secondary d-flex align-items-center" :class="{'btn-secondary':isPasswordVisible,'IonIcon':isPasswordVisible,'IonIconSize':true}" @click="changePasswordVisibility"><IonIcon :icon="isPasswordVisible ? eyeOffOutline:eyeOutline"></IonIcon></button>
        </div>
        <ErrorMessage name="password" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="password_confirm" class="mt-2">{{t('register.form.passwordConfirm')}}</label>
        <div class="input-group">
            <Field name="password_confirm" id="password_confirm" :type="passwordConfirmVisibility" class="form-control mt-1" />
            <button type="button" class="btn mt-1 btn-outline-secondary d-flex align-items-center" :class="{'btn-secondary':isPasswordConfirmVisible,'IonIcon':isPasswordConfirmVisible,'IonIconSize':true}" @click="changePasswordConfirmVisibility"><IonIcon :icon="isPasswordConfirmVisible ? eyeOffOutline:eyeOutline"></IonIcon></button>
        </div>
        <ErrorMessage name="password_confirm" as="div" class="alert alert-danger mt-2 mb-0" />
        <button type="submit" class="btn btn-success mt-2">{{t('register.form.button.register')}}</button>
    </VeeForm>
</template>


<style scoped>
.IonIcon {
    color:white;
}
.IonIconSize {
    font-size: 22px;

}
label {
    -webkit-user-select: none; /* Safari */
    -moz-user-select: none; /* Firefox */
    -ms-user-select: none; /* IE10+/Edge */
    user-select: none; /* Standard */
}
</style>
