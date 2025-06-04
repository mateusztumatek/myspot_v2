<script setup lang="ts">
  import {ref} from "vue";
  import {backendLink} from "@/utilies/helpers";
  import ExternalLoginButton from "@/components/Atoms/Login/ExternalLoginButton.vue";

  let ExternalLogins = ref([
    {
      name: 'Google',
      url: backendLink('/oauth/google/redirect'),
      icon: require('@/assets/socials/google.webp')
    },
    {
      name: 'Facebook',
      url: backendLink('/oauth/facebook/redirect'),
      icon: require('@/assets/socials/fb.png')
    }
  ]);
</script>
<template>
  <div class="my-5">
    <v-row no-gutters align="center" justify="center">
      <v-col
          v-for="login in ExternalLogins"
          :key="login.name"
          sm="4"
      >
        <ExternalLoginButton :name="login.name" :icon="login.icon" :url="login.url"></ExternalLoginButton>
      </v-col>
    </v-row>
  </div>
</template>