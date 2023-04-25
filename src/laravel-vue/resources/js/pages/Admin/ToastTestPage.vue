<template>

    <div class="container mt-2">
        <button class="btn btn-primary ms-1" @click="addAlertT">Add Toast Type 1</button>
        <button class="btn btn-primary ms-1" @click="addAlertTT">Add Toast Type 2</button>
        <button class="btn btn-primary ms-1" @click="addAlertTTT">Add Toast Type 3</button>
        <div class="row">
            <hr class="mt-3 border border-danger border-2 opacity-50">
            <div class="col-3 col-sm-3 col-md-3 col-xl-3 ">
                <label for="color mt-2">Bootstrap color:</label>
                <div class="input-group mt-1 mb-3 ">
                    <span class="input-group-text">bg-</span>
                    <input id="color" type="text" class="form-control" v-model="color">
                </div>
                <label for="color mt-2">Msg:</label>
                <div class="input-group mt-1 mb-3 ">
                    <input id="color" type="text" class="form-control" v-model="msg">
                </div>
                <button class="btn btn-primary form-control" @click="makeToast">Toast me !</button>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useAlertStore} from "../../stores/AlertStore";

const alertStore = useAlertStore();
function addAlertT() {
    alertStore.push("This is a msg !","warning");
}
function addAlertTT() {
    alertStore.push("TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT TEXT ","danger");
}function addAlertTTT() {
    alertStore.push("Alert !","primary");
}
</script>

<script>
import {useAlertStore} from "../../stores/AlertStore";

const alertStore = useAlertStore();
export default {
    data() {
        return {
            "color": "",
            "msg":"",
        }
    },
    methods: {
        makeToast(){
            alertStore.push(this.msg,this.color);
        }
    }
}
</script>

<style scoped>

</style>
