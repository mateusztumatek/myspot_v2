<script type="ts" setup>
  import {useAlertsStore} from "@/store/alerts";

  const alerts = useAlertsStore();

</script>

<template>
  <div class="alerts-panel">
    <v-fade-transition group>
      <div :key="index" v-for="(alert, index) in alerts.activeAlerts" class="w-50">
        <v-alert
            max-width="100%"
            :type="alert.type"
            closable
            :title="alert.title"
            :text="alert.message"
            @click:close="alert.close()"
        ></v-alert>
      </div>
    </v-fade-transition>
  </div>
</template>

<style lang="scss">
  .alerts-panel {
    display: flex;
    justify-content: center;
    flex-direction: column;
    align-items: center;
    width: 100%;
    position: fixed;
    bottom: 10px;
  }
</style>