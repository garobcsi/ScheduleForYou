<template >
    <div class="p-3 d-flex justify-content-between">
        <div class="list-group">
            <h6 class="mb-0">{{$t('settings.menu.deleteAccount.deleteTheAccount')}} </h6>
            <div>{{$t('settings.menu.deleteAccount.thisActionIs')}} <span class="text-danger">{{$t('settings.menu.deleteAccount.notReversible')}}</span> !</div>
        </div>
        <button data-bs-toggle="modal" type="button" data-bs-target="#modalUserDelete" class="btn btn-outline-danger d-flex align-items-center"><IonIcon class="icon" :icon="warning"/>{{$t('settings.menu.deleteAccount.button')}}</button>
        <!-- Modal -->
        <div ref="modal" class="modal fade" id="modalUserDelete" tabindex="-1" aria-labelledby="modalUserDelete" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalUserDelete">{{$t('settings.menu.deleteAccount.model.questionTitle')}}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h6 class="text-danger mb-0">{{$t('settings.menu.deleteAccount.model.thisActionIsNotReversible')}}</h6>
                        <div>{{$t('settings.menu.deleteAccount.model.questionAreYouSure')}}</div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$t('settings.menu.deleteAccount.model.close')}}</button>
                        <button type="button" class="btn btn-danger d-flex align-items-center d-flex align-items-center"  @click="deleteAccount" data-bs-dismiss="modal">
                                <IonIcon class="icon text-warning pe-1" :icon="nuclear"/> {{$t('settings.menu.deleteAccount.model.yesImSure')}}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>



</template>

<script setup>
import { IonIcon } from '@ionic/vue';
import { warning,nuclear } from 'ionicons/icons';
import {useAuthStore} from "../../stores/AuthStore";

function deleteAccount() {
    useAuthStore().deleteAccount();
}
</script>

<style scoped>
.icon {
    font-size: 22px;

}
</style>
