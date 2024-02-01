<script setup lang="ts">
  import {i18n} from "@/plugins/i18n";
  import {useI18n} from "vue-i18n";
  import {useStorage} from "@vueuse/core";

  let { locale } = useI18n({useScope: 'global'});
  const savedLocale = useStorage('locale', 'en');
  const setLocale = (language: string) => {
    locale.value = language;
    savedLocale.value = language;
  }
  locale.value = savedLocale.value;
  const locales = i18n.global.availableLocales;
</script>
<template>
  <v-footer class="d-flex flex-column mt-5">
    <v-btn
        flat
        :class="{'text-primary': locale === language}"
        text
        class="text-capitalize"
        v-for="language in locales"
        @click="setLocale(language)"
        :key="language">{{ language }}</v-btn>
  </v-footer>
</template>