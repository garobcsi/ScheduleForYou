<script setup>
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import {computed, ref} from "vue";
import {useAuthStore} from "../../stores/AuthStore";
import {useAlertStore} from "../../stores/AlertStore";
import {router} from "../../router";
import { IonIcon } from '@ionic/vue';
import { eyeOutline,eyeOffOutline } from 'ionicons/icons';

const authStore = useAuthStore();
const alertStore = useAlertStore();
const alert_danger = ref(null);
import { useI18n } from 'vue-i18n';
const { t, te } = useI18n();


const i18nSchema = computed(() => {
    return yup.object({
        email:
            yup.string()
                .email(t('login.form.validation.email'))
                .required(t('login.form.validation.required')),
        password:
            yup.string()
                .required(t('login.form.validation.required')),
    })
});
async function onSubmit(values) {
    if (authStore.isLogedIn) {
        alert_danger.value = "login.form.error.youAreAlreadyLogedIn";
        return;
    }
    authStore.stayLogedIn = values.stayLogedIn === true;
    delete values.stayLogedIn;
    await authStore.login(values);
    if (authStore.isLogedIn && !authStore.gotErrors) {
        alert_danger.value = null;
        alertStore.push('toast.login.success','success');
        router.push({name: 'index'});
    }
    else if (authStore.errorMsg.message === "Login Unsuccessful.") {
        alert_danger.value = "login.form.error.userOrPasswordWrong"
    }
    else {
        alertStore.push('toast.error','danger');
    }
}
function onChange() {
    alert_danger.value = null;
}
</script>
<script>
export default {
    data() {
        return {
            passwordVisibility: "password"
        }
    },
    methods: {
        changePasswordVisibility() {
            this.passwordVisibility = this.passwordVisibility === "password" ? 'text':'password'
        }
    },
    computed: {
        isPasswordVisible() {
            return this.passwordVisibility === 'text';
        }
    }
}
</script>
<template>
    <VeeForm @submit="onSubmit" @change="onChange" v-slot="{ values }" :validation-schema="i18nSchema">
        <div v-if="alert_danger !== null" class="alert alert-danger mb-0" role="alert">
            {{$t(alert_danger)}}
        </div>
        <label for="email" class="mt-2">{{$t('login.form.email')}}</label>
        <Field name="email" id="email" type="text" class="form-control mt-1" />
        <ErrorMessage name="email" as="div" class="alert alert-danger mt-2 mb-0" />
        <label for="password" class="mt-2">{{$t('login.form.password')}}</label>
        <div class="input-group">
            <Field name="password" id="password" :type="passwordVisibility" class="form-control mt-1" />
            <button type="button" class="btn mt-1 btn-outline-secondary d-flex align-items-center" :class="{'btn-secondary':isPasswordVisible,'IonIcon':isPasswordVisible,'IonIconSize':true}" @click="changePasswordVisibility"><IonIcon :icon="isPasswordVisible ? eyeOffOutline:eyeOutline"></IonIcon></button>
        </div>
        <ErrorMessage name="password" as="div" class="alert alert-danger mt-2 mb-0" />
        <div class="form-check mt-2">
            <Field name="stayLogedIn" id="stayLogedIn" type="checkbox" :value="true" class="form-check-input"/>
            <label class="form-check-label" for="stayLogedIn">
                {{$t('login.form.stayLogedIn')}}
            </label>
        </div>
        <button type="submit" class="btn btn-success mt-2">{{$t('login.form.button.login')}}</button>
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
