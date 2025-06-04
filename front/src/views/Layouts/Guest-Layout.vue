<script lang="ts" setup>
  //import LogoBlack from "@/assets/logo-black.svg";
  import LogoWhite from "@/assets/logo-white.svg";
  import LogoBlack from "@/assets/logo-black.svg";
  import {computed} from "vue";
  import {useDark} from "@vueuse/core";
  import FooterComponent from "@/components/Molecules/FooterComponent.vue";

  let isDark = useDark();
  let logo = computed(() => {
    return isDark.value ? LogoWhite : LogoBlack;
  })
</script>
<template>
    <v-app class="w-100">
        <div class="d-flex justify-center align-center flex-column align-center">
          <v-img width="100px" :src="logo"></v-img>
        </div>
        <router-view></router-view>
        <footer-component></footer-component>
    </v-app>
</template>