import { createApp } from 'vue'
import App from './App.vue'
import './registerServiceWorker'
import router from './router'
import vuetify from './plugins/vuetify';
import { createPinia } from 'pinia'
import {i18n} from "@/plugins/i18n";


const pinia = createPinia()

createApp(App)
    .use(i18n)
    .use(router)
    .use(vuetify)
    .use(pinia)
    .mount('#app')
