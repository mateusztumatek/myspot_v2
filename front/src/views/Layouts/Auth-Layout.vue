<script lang="ts" setup>
  //import LogoBlack from "@/assets/logo-black.svg";
  import LogoWhite from "@/assets/logo-white.svg";
  import LogoBlack from "@/assets/logo-black.svg";
  import LogoutComponent from "@/components/Atoms/LogoutComponent.vue";
  import {computed} from "vue";
  import {useDark} from "@vueuse/core";
  import FooterComponent from "@/components/Molecules/FooterComponent.vue";

  let isDark = useDark();
  let logo = computed(() => {
    return isDark.value ? LogoWhite : LogoBlack;
  })
</script>
<template>
    <v-app class="w-100 d-flex flex-column align-center">
        <v-img width="200px" :src="logo"></v-img>
        <LogoutComponent></LogoutComponent>
        <router-view></router-view>
        <footer-component></footer-component>
    </v-app>
</template>