<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>{{$t('Your account')}}</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <div class="ion-padding">
        <logout-action v-slot:default="{logout}">
          <ion-button color="primary">{{$t('Logout')}}</ion-button>
        </logout-action>
      </div>
    </ion-content>
  </ion-page>
</template>
<script setup lang="ts">
import {IonPage, IonContent, IonHeader, IonTitle, IonToolbar, IonButton} from "@ionic/vue";
import LogoutAction from "@/components/logout-action.vue";
</script>