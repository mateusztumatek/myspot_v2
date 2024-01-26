import { createApp } from 'vue'
import { createVuetify } from 'vuetify'
import { VCard } from 'vuetify/components/VCard'
import { VRating } from 'vuetify/components/VRating'
import { VToolbar } from 'vuetify/components/VToolbar'
import { VBtn } from "vuetify/components/VBtn";
import { Ripple } from 'vuetify/directives'
import {VImg} from "vuetify/components/VImg";
import {VForm} from "vuetify/components/VForm";
import {VTextField} from "vuetify/components/VTextField";
import {VSheet} from "vuetify/components/VSheet";
import 'vuetify/styles'


const vuetify = createVuetify({
    components: {
        VImg,
        VBtn,
        VCard,
        VRating,
        VToolbar,
        VSheet,
        VForm,
        VTextField
    },
    directives: {
        Ripple,
    },
})

export default vuetify
