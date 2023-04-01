<template>
    <div class="
    col-12
    offset-sm-6 col-sm-6
    offset-md-8 col-md-4
    offset-xl-9 col-xl-3
    pb-3 pe-3 ps-3 ps-sm-0"
         id="AlertBox">
        <AlertPopup :color="item.color" v-for="(item, index) in alertStore.data" :key="item.id" :pkey="item.id">
            {{item.message}}
        </AlertPopup>
    </div>
</template>

<script setup>
import AlertPopup from "../bootstrap/AlertPopup.vue";
import {useAlertStore} from "../../stores/AlertStore";
const alertStore = useAlertStore();
</script>

<style scoped>
#AlertBox {
    position: fixed;
    bottom: 0;
    max-height: 100vh;
    overflow: auto;
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
#AlertBox::-webkit-scrollbar {
    display: none;
}
</style>
