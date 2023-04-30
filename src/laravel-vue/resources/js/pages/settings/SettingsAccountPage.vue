<template>
    <div class="container">
        <div class="row">
            <settings-items>
                <h3 class="mt-2">
                    {{$t('settings.menu.yourAccount')}}
                </h3>
                <hr class="border border-1 mt-2 border-dark">
                <SettingsPasswordReset/>
            </settings-items>
        </div>
    </div>
</template>

<script setup>
import SettingsItems from "../../components/layuots/SettingsItems.vue";
import SettingsPasswordReset from "../../components/settings/SettingsPasswordReset.vue";
</script>

<style scoped>

</style>
