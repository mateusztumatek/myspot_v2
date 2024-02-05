<template>
  <ion-app>
    <ion-page>
      <ion-tabs>
        <ion-router-outlet :animation="fadeIn()"/>
        <ion-tab-bar slot="bottom">
          <ion-tab-button tab="home" href="/dashboard/home">
            <ion-icon aria-hidden="true" :icon="homeOutline" />
            <ion-label>{{ $t('Home') }}</ion-label>
          </ion-tab-button>

          <ion-tab-button tab="account" href="/dashboard/account">
            <ion-icon aria-hidden="true" :icon="personOutline" />
            <ion-label>{{$t('User account')}}</ion-label>
          </ion-tab-button>
        </ion-tab-bar>
      </ion-tabs>
    </ion-page>
  </ion-app>
</template>

<script setup lang="ts">
import {IonApp, IonIcon, IonLabel, IonPage, IonRouterOutlet, IonTabBar, IonTabButton, IonTabs} from '@ionic/vue';
import {ellipse, square, triangle, personOutline, homeOutline} from "ionicons/icons";
import {fadeIn} from "@/utilies/animations";
import {theme, toggleTheme, setTheme} from '@/utilies/theme-switcher';
setTheme();
</script>