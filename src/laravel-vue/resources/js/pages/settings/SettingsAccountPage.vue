<template>
    <div class="container">
        <div class="row">
            <settings-items>
                <h3 class="mt-2">
                    {{$t('settings.menu.yourAccount')}}
                </h3>
                <hr class="border border-1 mt-2 border-dark">
                <SettingsPasswordReset/>
                <SettingsLogoutAllAccount/>
                <div class="col-xl-8">
                    <div class="h4 pb-2 mb-3 text-uppercase text-danger border-bottom border-danger">
                        {{$t('settings.menu.deleteAccount.title')}}
                    </div>
                    <ul class="list-group border border-danger rounded-2 ">
                        <SettingsDeleteAccount class="list-group-item"/>
                    </ul>
                </div>
                <div class="my-5"/>
            </settings-items>
        </div>
    </div>
</template>

<script setup>
import SettingsItems from "../../components/layuots/SettingsItems.vue";
import SettingsPasswordReset from "../../components/settings/SettingsPasswordReset.vue";
import SettingsLogoutAllAccount from "../../components/settings/SettingsLogoutAllAccount.vue";
import SettingsDeleteAccount from "../../components/settings/SettingsDeleteAccount.vue";
</script>

<style scoped>
.list-group > .list-group-item:not(:last-child) {
    border-bottom-color: black;
}
</style>
