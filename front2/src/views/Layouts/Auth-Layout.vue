<template>
  <ion-page>
    <ion-tabs ref="tabs">
      <ion-router-outlet/>
      <ion-tab-bar slot="bottom" class="ion-tab-bar">
        <ion-tab-button tab="home" href="/dashboard/home">
          <ion-icon aria-hidden="true" :icon="homeOutline" />
          <ion-label>{{ $t('Home') }}</ion-label>
        </ion-tab-button>
        <ion-tab-button tab="createEvent" href="/dashboard/create-event">
          <ion-icon aria-hidden="true" :icon="addCircleOutline" />
          <ion-label>{{ $t('Create Event') }}</ion-label>
        </ion-tab-button>
        <ion-tab-button tab="account" href="/dashboard/account">
          <ion-icon aria-hidden="true" :icon="personOutline" />
          <ion-label>{{$t('User account')}}</ion-label>
        </ion-tab-button>
      </ion-tab-bar>
    </ion-tabs>
  </ion-page>
</template>

<script setup lang="ts">
import {IonApp, IonIcon, IonLabel, IonPage, IonRouterOutlet, IonTabBar, IonTabButton, IonTabs} from '@ionic/vue';
import {ellipse, square, triangle, personOutline, homeOutline, addCircleOutline} from "ionicons/icons";
import {fadeIn} from "@/utilies/animations";
import {ref, onMounted} from 'vue';
import {useRoute} from "vue-router";
import {useIonRouter} from "@ionic/vue";
import {theme, toggleTheme, setTheme} from '@/utilies/theme-switcher';
setTheme();

const route = useRoute();
const isSelectedTab = (tab: string) => {
  return route.matched.some((record) => record.name === tab);
}
</script>
<style lang="scss">
  .ion-tab-bar {
    --ion-background-color: #262626;
    --ion-color-step-650: #b9b9b9;
  }
</style>