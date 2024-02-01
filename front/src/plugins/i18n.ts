import {createI18n} from "vue-i18n";
import {useStorage} from "@vueuse/core/index";
import en from '@/locales/en.json';
import pl from '@/locales/pl.json';
import {useUserStore} from "@/store/user";

const i18n = createI18n({
    locale: 'en',
    fallbackLocale: 'en',
    globalInjection: true,
    legacy: false,
    messages: {
        en: en,
        pl: pl,
    }
})

const $t = i18n.global.t;
export {
    i18n,
    $t
}
