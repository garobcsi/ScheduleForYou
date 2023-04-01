<script>
import {useAlertStore} from "../../stores/AlertStore";
import VueCountdown from '@chenfengyuan/vue-countdown';
export default {
    props: {
        color: String,
        pkey: Number,
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
<script setup>
import {ref} from "vue";
const countDownTime = ref(10); //set the time
const cssCountDownTime = ref(countDownTime.value+"s");
</script>

<template>
    <div :class="'alert-'+this.color" class="alert alert-dismissible fade show mb-0 mt-1 p-0" role="alert">
        <div class="m-3 me-5">
            <slot></slot>
        </div>
        <button @click="dismiss" type="button" class="btn-close" aria-label="Close"></button>
        <vue-countdown :time="countDownTime*1000" :emit-events="false" @end="dismiss">
            <div class="progress">
                <div :class="'bg-'+this.color" class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
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
    .progress-bar {
        animation-name: bar;
        animation-duration: v-bind(cssCountDownTime);
        animation-timing-function: linear;
    }
    @keyframes bar {
        from {width: 100%;}
        to {width: 0;}
    }
</style>
