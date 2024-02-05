<template>
  <ion-app>
    <ion-router-outlet />
  </ion-app>
</template>

<script setup lang="ts">
import { IonApp, IonRouterOutlet } from '@ionic/vue';
import {theme, toggleTheme, setTheme} from '@/utilies/theme-switcher';
setTheme();
</script>