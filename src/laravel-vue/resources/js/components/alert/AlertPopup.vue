<script>
import {useAlertStore} from "../../stores/AlertStore";
import VueCountdown from '@chenfengyuan/vue-countdown';
export default {
    props: {
        color: String,
        pkey: Number,
    },
    data() {
      return {
          cssTimeBarVisibility: null,
          isComponentHover: true
      }
    },
    methods: {
        dismiss() {
            useAlertStore().remove(this.pkey);
        },
        play() {
            if (this.$refs.countdown === null) return;
            this.isComponentHover = true;
            this.cssTimeBarVisibility = null;
            this.$refs.countdown.restart();
        },
        pause() {
            if (this.$refs.countdown === null) return;
            this.isComponentHover = false;
            this.cssTimeBarVisibility = 0;
            this.$refs.countdown.pause();
        }
    },
    computed: {
        getColor() {
            return ["primary","success","danger","warning","info","dark"].includes(this.color) ? this.color : "primary";
        }
    },
    components: {
        VueCountdown
    }
}
</script>
<script setup>
import {ref} from "vue";
const countDownTime = ref(5); //set the time
const cssCountDownTime = ref(countDownTime.value+"s");
</script>

<template>
    <div :class="{[`alert-${getColor}`]:true}" class="alert alert-dismissible fade show mb-0 mt-1 p-0" role="alert" @mouseover="pause" @mouseleave="play">
        <div class="m-3 me-5" style="min-height: 21px">
            <slot></slot>
        </div>
        <button @click="dismiss" type="button" class="btn-close" aria-label="Close"></button>
        <vue-countdown ref="countdown" :time="countDownTime*1000" @end="dismiss">
            <div class="progress">
                <div :class="{[`bg-${getColor}`]:true,'animation':isComponentHover}"  class="progress-bar" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
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
        opacity: v-bind(cssTimeBarVisibility);
    }
    .animation {
        animation-name: bar;
        animation-duration: v-bind(cssCountDownTime);
        animation-timing-function: linear;
    }
    @keyframes bar {
        from {width: 100%;}
        to {width: 0;}
    }
</style>
