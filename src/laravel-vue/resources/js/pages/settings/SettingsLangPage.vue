<template>
    <div class="container">
        <div class="row">
            <settings-items >
                <h3 class="mt-2">
                    {{$t('settings.menu.language')}}
                </h3>
                <hr class="border border-1 mt-2 border-dark">
                <SettingsLang/>

            </settings-items>
        </div>
    </div>
</template>
<script setup>
import SettingsLang from "../../components/settings/SettingsLang.vue";
import SettingsItems from "../../components/layuots/SettingsItems.vue";
</script>
