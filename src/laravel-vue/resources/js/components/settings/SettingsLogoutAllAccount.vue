<template>
    <div class="col-xl-8">
        <h6>{{$t('settings.menu.logoutAll.title')}}</h6>
        <button type="button" class="btn btn-outline-danger mb-3" data-bs-toggle="modal" data-bs-target="#modalLogoutAll">
            {{$t('settings.menu.logoutAll.button')}}
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="modalLogoutAll" tabindex="-1" aria-labelledby="modalLogoutAll" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalLogoutAll">{{$t('settings.menu.logoutAll.model.questionTitle')}}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    {{$t('settings.menu.logoutAll.model.questionAreYouSure')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{$t('settings.menu.logoutAll.model.close')}}</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" @click="logoutAll">{{$t('settings.menu.logoutAll.model.yesImSure')}}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import {useAuthStore} from "../../stores/AuthStore";
function logoutAll() {
    useAuthStore().logoutAll(false);
}
</script>
