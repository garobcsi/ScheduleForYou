<template>
    <div class="container">
        <div class="row">
            <settings-items >
                <h3 class="mt-2">
                    {{$t('settings.menu.yourProfile')}}
                </h3>
                <hr class="border border-1 mt-2 border-dark">
                <SettingsUsername/>
                <SettingsEmail/>
                <div class="my-5"/>
            </settings-items>
        </div>
    </div>
</template>

<script setup>
import SettingsItems from "../../components/layuots/SettingsItems.vue";
import SettingsUsername from "../../components/settings/SettingsUsername.vue";
import SettingsEmail from "../../components/settings/SettingsEmail.vue";
</script>

<style scoped>
</style>
