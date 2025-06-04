<script setup lang="ts">
  import {retrieveAndSetUserDevice} from "@/utilies/authrizeUserForCloudMessaging";
</script>
<template>
  <div>
    <v-card>
      {{$t('account.list_temporary_unavailable')}}
    </v-card>
  </div>
</template>