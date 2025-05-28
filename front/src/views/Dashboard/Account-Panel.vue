<script setup lang="ts">
  import {retriveAndSetUserDevice} from "@/utilies/authrizeUserForCloudMessaging";
</script>
<template>
  <div>
    <v-btn @click="retriveAndSetUserDevice()">Pobierz token klienta</v-btn>
  </div>
</template>