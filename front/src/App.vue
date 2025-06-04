<template>
  <div>
    <ThemeSwitcher></ThemeSwitcher>
    <router-view/>
    <AlertsPanel></AlertsPanel>
  </div>
</template>

<script setup lang="ts">
import AlertsPanel from "@/views/Layouts/Alerts-Panel.vue";
import ThemeSwitcher from "@/components/ThemeSwitcher.vue";
</script>