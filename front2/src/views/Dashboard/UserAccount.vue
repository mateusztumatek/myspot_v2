<template>
  <ion-page>
    <ion-header>
      <ion-toolbar>
        <ion-buttons slot="start">
          <ion-back-button text="Back"></ion-back-button>
        </ion-buttons>
        <ion-title>{{$t('Your account')}}</ion-title>
      </ion-toolbar>
    </ion-header>
    <ion-content :fullscreen="true">
      <ion-list>
        <editable-item @click="updateUserAvatar()">
          <ion-label>
            <ion-avatar style="max-width: 40px; max-height: 40px">
              <img alt="Avatar" src="https://ionicframework.com/docs/img/demos/avatar.svg" />
            </ion-avatar>
          </ion-label>
        </editable-item>
      </ion-list>
      <div class="ion-padding">
        <logout-action v-slot:default="{logout}">
          <ion-button @click="logout()" color="primary">{{$t('Logout')}}</ion-button>
        </logout-action>
      </div>
    </ion-content>
  </ion-page>
</template>
<script setup lang="ts">
import {IonPage, IonContent, IonHeader, IonTitle, IonToolbar, IonButton, IonList, IonLabel, IonAvatar} from "@ionic/vue";
import LogoutAction from "@/components/logout-action.vue";
import EditableItem from "@/components/List/EditableItem.vue";
import {useFileSystemAccess} from "@vueuse/core";
import Request from "@/plugins/request";
import {useAxios} from "@vueuse/integrations/useAxios";

const {execute} = useAxios('api/user/update',{}, Request, {immediate: false});
const {open, file} = useFileSystemAccess({
  types: [{
    description: 'Images',
    accept: {'image/*': ['.png', '.jpg', '.jpeg', '.gif']},
  }],
  excludeAcceptAllOption: true
});

const updateUserAvatar = async() => {
  const image = await open();

  await execute({method: 'PUT', data:{avatar: file.value}});

}
</script>