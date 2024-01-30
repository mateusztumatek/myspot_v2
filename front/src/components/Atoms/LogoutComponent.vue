<script setup type="ts">
  import {useUserStore} from "@/store/user";

  const userStore = useUserStore();

  const logout = async () => {
    userStore.logout();
  }
</script>
<template>
  <v-btn icon @click="logout()"><v-icon>mdi-logout</v-icon></v-btn>
</template>