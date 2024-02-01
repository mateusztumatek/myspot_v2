import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import { VCard, VCardActions, VCardTitle, VCardText, VCardItem, VCardSubtitle } from 'vuetify/components/VCard'
import { VRating } from 'vuetify/components/VRating'
import { VToolbar } from 'vuetify/components/VToolbar'
import { VBtn } from "vuetify/components/VBtn";
import { Ripple } from 'vuetify/directives'
import {VImg} from "vuetify/components/VImg";
import {VForm} from "vuetify/components/VForm";
import {VTextField} from "vuetify/components/VTextField";
import {VSheet} from "vuetify/components/VSheet";
import {VAlert} from "vuetify/components/VAlert";
import {VFadeTransition} from "vuetify/components/transitions";
import {VIcon} from "vuetify/components/VIcon";
import {VDialog} from "vuetify/components/VDialog";
import {VSpacer} from "vuetify/components/VGrid";
import {VFooter} from "vuetify/components/VFooter";
import {VApp} from "vuetify/components/VApp";
import {VRow, VCol} from "vuetify/components/VGrid";
import "@/css/main.scss"
import '@mdi/font/css/materialdesignicons.css'
import {VSwitch} from "vuetify/components/VSwitch"; // Ensure you are using css-loader




const vuetify = createVuetify({
    theme:{
        defaultTheme: 'dark'
    },
    components: {
        VImg,
        VBtn,
        VCard,
        VCardActions,
        VCardTitle,
        VCardText,
        VCardItem,
        VCardSubtitle,
        VRating,
        VToolbar,
        VSheet,
        VForm,
        VTextField,
        VAlert,
        VFadeTransition,
        VSwitch,
        VIcon,
        VDialog,
        VSpacer,
        VFooter,
        VApp,
        VRow,
        VCol
    },
    directives: {
        Ripple,
    },
    icons: {
        defaultSet: 'mdi',
    }
})

export default vuetify
