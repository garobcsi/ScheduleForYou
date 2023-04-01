<script>
import {useAlertStore} from "../../stores/AlertStore";
import VueCountdown from '@chenfengyuan/vue-countdown';
export default {
    props: {
        color: String,
        pkey: Number
    },
    data() {
        return {
            countDownTime: 10*1000
        }
    },
    methods: {
        dismiss() {
            useAlertStore().remove(this.pkey);
        }
    },
    components: {
        VueCountdown
    }
}
</script>

<template>
    <div :class="'alert-'+this.color" class="alert alert-dismissible fade show mb-0 mt-1 p-0" role="alert">
        <div class="m-3 me-5">
            <slot></slot>
        </div>
        <button @click="dismiss" type="button" class="btn-close" aria-label="Close"></button>
        <vue-countdown :time="countDownTime"  v-slot="{totalSeconds}" @end="dismiss">
            <div class="progress">
                <div :style="{'width': (totalSeconds/(countDownTime/1000))*100+'%'}" :class="'bg-'+this.color" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </vue-countdown>
    </div>
</template>

<style scoped>
    .alert {
        font-size: 85%;
    }
    .progress {
        height: 8px;
    }
</style>
