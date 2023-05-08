<template>
<VeeForm v-slot="{ values }" @submit="onSubmit" :validation-schema="i18nSchema" ref="formRef">
    <div ref="modalRef" class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen-md-down modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLabel">{{picked === "btnradio1" ? 'Add Date' : 'Add Routine'}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body ">
                    <div class="btn-group d-flex float-md-start" role="group" aria-label="Basic radio toggle button group ">
                        <input type="radio" class="btn-check" name="btnradio1" id="btnradio1" value="btnradio1" autocomplete="off" checked v-model="picked">
                        <label class="btn btn-outline-primary d-flex align-items-center justify-content-sm-center" for="btnradio1"><IonIcon class="icons pe-1" :icon="calendarNumberOutline"/> Date</label>

                        <input type="radio" class="btn-check" name="btnradio2" id="btnradio2" value="btnradio2" autocomplete="off" v-model="picked">
                        <label class="btn btn-outline-primary d-flex align-items-center justify-content-sm-center" for="btnradio2"><IonIcon class="icons pe-1" :icon="calendarOutline"/> Routine</label>
                    </div>
                    <div class="col-12 d-flex flex-column">
                        <label for="name" class="mt-2">Name</label>
                        <Field name="name" id="name" type="text" class="form-control mt-1" />
                        <ErrorMessage name="name" as="div" class="alert alert-danger mt-2 mb-0" />

                        <label for="start" class="mt-2">{{picked === "btnradio1" ? 'Start Date' : 'Start Routine'}}</label>
                        <Field name="start" id="start" type="datetime-local" class="form-control mt-1"/>
                        <ErrorMessage name="start" as="div" class="alert alert-danger mt-2 mb-0" />

                        <label for="end" class="mt-2">{{picked === "btnradio1" ? 'End Date' : 'End Routine'}}</label>
                        <Field name="end" id="end" type="datetime-local" class="form-control mt-1" />
                        <ErrorMessage name="end" as="div" class="alert alert-danger mt-2 mb-0" />

                        <div v-show="picked === 'btnradio2'">
                            <label for="repeat_time" class="mt-2">Repeat Time</label>
                            <Field name="repeat_time" id="repeat_time" as="select" class="form-select mt-1">
                                <option value="" selected>--Select--</option>
                                <option v-for="item in locale === 'en' ? routineEnType : routineHuType" :value="item.value" :key="item.value">{{item.name}}</option>
                            </Field>
                            <ErrorMessage name="repeat_time" as="div" class="alert alert-danger mt-2 mb-0" />
                        </div>

                        <label for="description" class="mt-2">Description</label>
                        <Field as="textarea" name="description" id="description" type="datetime-local" class="form-control mt-1" />
                        <ErrorMessage name="description" as="div" class="alert alert-danger mt-2 mb-0" />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" >Save</button>
                </div>
            </div>
        </div>
    </div>
</VeeForm>

</template>

<script setup>
import { Form as VeeForm, Field, ErrorMessage } from 'vee-validate';
import * as yup from 'yup';
import { IonIcon } from '@ionic/vue';
import {calendarNumberOutline, calendarOutline} from 'ionicons/icons';
import {Modal} from "bootstrap";
import {computed, onMounted, ref, watch} from "vue";
import {api} from "../../utils/api";
import {useI18n} from "vue-i18n";
import {pick} from "lodash/object";

const props = defineProps({
    start: String,
    end: String,
    allDay: Boolean,
})

const modalRef = ref(null);
let modal = null;
onMounted(()=> {
    modal = new Modal(modalRef.value);
});
function _show() {
    modal.show();
}
defineExpose({ show: _show });

const picked = ref("btnradio1");

const i18nSchema = computed(() => {
    return yup.object({
        name:
            yup.string()
                .max(100)
                .required(),
        start:
            yup.date()
                .required(),
        end:
            yup.date()
                .required(),
        repeat_time:
            picked.value === "btnradio1"? yup.string() :yup.string().required(),
        description:
            yup.string()
    })
});


async function onSubmit(values) {
    console.log(values);
    modal.hide();
}

const formRef = ref(null);
watch(props,() => {
    let start = new Date(props.start);
    let end = new Date(props.end);
    if (!props.allDay) {
        start.setHours(start.getHours()+2);
        end.setHours(end.getHours() +2);
    }
    if (start.getDate() !== end.getDate() -1 && props.allDay) end.setDate(end.getDate() - 1);
    formRef.value.setValues({
        name: '',
        start: start.toISOString().split('.')[0],
        end: end.toISOString().split('.')[0],
        textarea: "",
        repeat_time: ""
    });
});

const { locale } = useI18n({useScope: 'global'})

const routineEnType = ref({});
const routineHuType = ref({});
api.get('/user/routine/enum').then(x=>routineEnType.value=x.data.data);
api.get('/user/routine/enum/hu').then(x=>routineHuType.value=x.data.data);
</script>

<style scoped>
.icons {
    font-size: 22px;
}
</style>
