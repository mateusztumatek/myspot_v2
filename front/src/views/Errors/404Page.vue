<template>
  <div class="w-100 d-flex justify-center flex-column align-center">
      <v-img width="700px" max-width="100%" :src="require('@/assets/404.png')"></v-img>
      <v-btn to="/">{{$t('errors.go_home')}}</v-btn>
  </div>
</template>

<script setup type="ts">
  import {i18n} from "@/plugins/i18n";

  console.log(i18n.global.locale);
</script>