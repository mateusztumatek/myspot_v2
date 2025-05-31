<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-title>{{$t('Create event')}}</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-list>
        <ion-item>
          <ion-input label-placement="floating" v-model="form.name" required :label="$t('Event name')" />
        </ion-item>

        <ion-item>
          <ion-select label-placement="floating" v-model="form.category" interface="alert" :label="$t('Category')">
            <ion-select-option value="music">Music</ion-select-option>
            <ion-select-option value="sports">Sports</ion-select-option>
            <ion-select-option value="conference">Conference</ion-select-option>
            <ion-select-option value="meetup">Meetup</ion-select-option>
          </ion-select>
        </ion-item>

        <ion-item>
          <ion-label>Visibility</ion-label>
        </ion-item>
        <ion-radio-group v-model="form.visibility">
          <ion-item>
            <ion-radio value="public">Public</ion-radio>
          </ion-item>
          <ion-item>
            <ion-radio value="private">Private</ion-radio>
          </ion-item>
        </ion-radio-group>

        <ion-item>
          <ion-label position="stacked">Start Date & Time</ion-label>
          <ion-datetime v-model="form.start" display-format="YYYY-MM-DD HH:mm" />
        </ion-item>

        <ion-item>
          <ion-label position="stacked">End Date & Time</ion-label>
          <ion-datetime v-model="form.end" display-format="YYYY-MM-DD HH:mm" />
        </ion-item>
      </ion-list>

      <ion-button expand="block" class="ion-margin-top" @click="submitForm">
        Create Event
      </ion-button>
    </ion-content>
  </ion-page>
</template>
<script lang="ts" setup>

import {IonContent, IonHeader, IonPage, IonTitle, IonToolbar, IonRadioGroup, IonRadio} from "@ionic/vue";
import {ref} from "vue";

const form = ref<{
  name: string,
  category: string,
  visibility: string,
  start: string,
  end: string
}>({
  name: '',
  category: 'music',
  visibility: 'public',
  start: '',
  end: ''
});
</script>