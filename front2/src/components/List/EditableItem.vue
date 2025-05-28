<template>
  <ion-item>
    <slot slot="start"></slot>
    <ion-note slot="end">
      <ion-icon color="medium" style="width: 20px; height: 20px" :icon="createOutline"></ion-icon>
    </ion-note>
  </ion-item>
</template>
<script lang="ts" setup>
  import { IonItem, IonNote, IonIcon } from '@ionic/vue';
  import {createOutline} from "ionicons/icons";
</script>