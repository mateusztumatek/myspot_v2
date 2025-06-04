<script setup type="ts">
  import {useUserStore} from "@/store/user";
  import {ref} from "vue";

  const userStore = useUserStore();

  const loading = ref(false);
  const logout = async () => {
    loading.value = true;
    try{
      await userStore.logout();
    }finally {
      loading.value = false;
    }
  }
</script>
<template>
  <v-btn :loading="loading" icon @click="logout()"><v-icon>mdi-logout</v-icon></v-btn>
</template>