<template>
  <v-toolbar class="text-white" title="MySpot">
    <v-btn icon="mdi-menu"></v-btn>
    <LogoutComponent />
  </v-toolbar>
</template>
<script lang="ts" setup>
import {i18n} from "@/plugins/i18n";
import LogoutComponent from "@/components/Atoms/LogoutComponent.vue";
</script>