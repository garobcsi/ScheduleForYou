import {createApp} from 'vue';
import {createPinia} from 'pinia';
import {router} from '@/router/index.js'
import App from '@/App.vue';
import {onStartup} from "./onStarup";
import { createI18n } from 'vue-i18n'
import {useAuthStore} from "./stores/AuthStore";
import {api} from "./utils/api";

import hu from '@/locales/hu.mjs'
import en from '@/locales/en.mjs'
(async () => {
    const messages = { hu, en}

    const app = createApp(App);
    app.use(createPinia());
    onStartup();

    let locale = ["en","hu"].includes(localStorage.getItem('locale')) ? localStorage.getItem('locale') : "hu";
    if (useAuthStore().isLogedIn) {
        let dataSuccess = null;
        await api.get('/user/settings').then(x=>dataSuccess=x.data);
        if (dataSuccess !== null) locale = dataSuccess.data.lang;
    }
    const i18n = createI18n({
        legacy: false,
        messages,
        locale: locale,
        fallbackLocal: 'en'
    });

    app.use(i18n);
    app.use(router);
    app.mount("#app");
})();