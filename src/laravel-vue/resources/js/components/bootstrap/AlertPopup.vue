<script>
import {useAlertStore} from "../../stores/AlertStore";
export default {
    props: {
        color: String,
        pkey: Number
    },
    methods: {
        dismiss() {
            let index = this.pkey;
            setTimeout(function() {useAlertStore().remove(index);}, 90);
        }
    }
}
</script>

<template>
    <div :class="'alert-'+this.color" class="alert alert-dismissible fade show mb-0 text-break mt-1" role="alert">
        <slot class="text-wrap"></slot>
        <button @click="dismiss" type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</template>

<style scoped>
    .alert {
        font-size: 85%;
    }
</style>
