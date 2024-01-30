<template>
  <div>
    <ThemeSwitcher></ThemeSwitcher>
    <router-view/>
    <AlertsPanel></AlertsPanel>
  </div>
</template>

<script type="ts" setup>
  import {onMounted} from "vue";
  import {getCsrf} from "@/api/user";
  import AlertsPanel from "@/views/Layouts/Alerts-Panel.vue";
  import ThemeSwitcher from "@/components/ThemeSwitcher.vue";

  onMounted(() => {
    getCsrf();
  })
</script>
