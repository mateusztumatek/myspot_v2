<script lang="ts" setup>
  //import LogoBlack from "@/assets/logo-black.svg";
  import LogoWhite from "@/assets/logo-white.svg";
  import LogoBlack from "@/assets/logo-black.svg";
  import LogoutComponent from "@/components/Atoms/LogoutComponent.vue";
  import {computed} from "vue";
  import {useDark} from "@vueuse/core";
  import FooterComponent from "@/components/Molecules/FooterComponent.vue";
  import AppHeader from "@/views/Layouts/AppHeader.vue";

  let isDark = useDark();
  let logo = computed(() => {
    return isDark.value ? LogoWhite : LogoBlack;
  })
</script>
<template>
    <v-app>
        <AppHeader />
        <router-view></router-view>
        <footer-component></footer-component>
    </v-app>
</template>