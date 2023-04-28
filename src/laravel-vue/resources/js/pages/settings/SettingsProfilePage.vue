<template>
    <div class="container">
        <div class="row">
            <settings-items >
                <h3 class="mt-2">
                    Your Profile
                </h3>
                <hr class="border border-1 mt-2 border-dark">
                <VeeForm @submit="onSubmit" v-slot="{ values }" :validation-schema="i18nSchema">
<!--                    <div v-if="alert_danger !== null" class="alert alert-danger mb-0" role="alert">-->
<!--                        {{$t(alert_danger)}}-->
<!--                    </div>-->
<!--                    <label for="email" class="mt-2">{{$t('login.form.email')}}</label>-->
<!--                    <Field name="email" id="email" type="text" class="form-control mt-1" />-->
<!--                    <ErrorMessage name="email" as="div" class="alert alert-danger mt-2 mb-0" />-->
<!--                    <label for="password" class="mt-2">{{$t('login.form.password')}}</label>-->
<!--                    <div class="input-group">-->
<!--                        <Field name="password" id="password" :type="passwordVisibility" class="form-control mt-1" />-->
<!--                        <button type="button" class="btn mt-1 btn-outline-secondary d-flex align-items-center" :class="{'btn-secondary':isPasswordVisible,'IonIcon':isPasswordVisible,'IonIconSize':true}" @click="changePasswordVisibility"><IonIcon :icon="isPasswordVisible ? eyeOffOutline:eyeOutline"></IonIcon></button>-->
<!--                    </div>-->
<!--                    <ErrorMessage name="password" as="div" class="alert alert-danger mt-2 mb-0" />-->
<!--                    <div class="form-check mt-2">-->
<!--                        <Field name="stayLogedIn" id="stayLogedIn" type="checkbox" :value="true" class="form-check-input"/>-->
<!--                        <label class="form-check-label" for="stayLogedIn">-->
<!--                            {{$t('login.form.stayLogedIn')}}-->
<!--                        </label>-->
<!--                    </div>-->

                    <button type="submit" class="btn btn-success mt-2">Update</button>
                </VeeForm>
            </settings-items>
        </div>
    </div>
</template>

<script setup>
import SettingsItems from "../../components/layuots/SettingsItems.vue";
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { useI18n } from 'vue-i18n';
import {computed} from "vue";
const { t, te } = useI18n();
const i18nSchema = computed(() => {
    return yup.object({
        username: yup.string().min(3).max(255).required(),
        email:
            yup.string()
                .email()
                .required(),
    })
});

async function onSubmit(values) {

}
</script>

<style scoped>

</style>
