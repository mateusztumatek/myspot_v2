<template>
  <ion-page>
    <ion-router-outlet />
  </ion-page>
</template>

<script setup lang="ts">
import { IonApp, IonRouterOutlet, IonPage } from '@ionic/vue';
import {theme, toggleTheme, setTheme} from '@/utilies/theme-switcher';
setTheme();
</script>