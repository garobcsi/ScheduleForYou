import { defineStore } from 'pinia'
import {api} from "../utils/api";
export const useAlertStore = defineStore('alert-store', {
    state() {
        return {
            data:[]
        }
    },
    actions: {
        push(msg,color) {
            this.data.push({id:this.data.length === 0 ? 0 : this.data.at(-1).id+1,message:msg,color:color});
            const alert = document.getElementById('AlertBox');
            setTimeout(function() {alert.scrollTo({
                top: alert.scrollHeight,
                left:0,
                behavior: "smooth"
            });}, 1);
        },
        remove(index) {
            const findIndex = this.data.findIndex(x => x.id === index);
            this.data.splice(findIndex,1);
        }
    },
    getters: {

    },
})
