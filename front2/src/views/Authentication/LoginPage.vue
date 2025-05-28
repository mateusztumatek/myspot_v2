<script lang="ts" setup>
import {IonPage, IonContent, IonRow, IonItem, IonIcon, IonButton, IonGrid, IonCol, IonLoading, IonInput} from "@ionic/vue";
import {airplane, mailOutline, lockClosed, logoFacebook, logoGoogle} from "ionicons/icons";
import {reactive, ref} from "vue";
import ExploreContainer from "@/components/ExploreContainer.vue";
import {useUserStore} from "@/store/user";
import Request from "@/plugins/request";
import Divider from "@/components/Divider.vue";
import axios, {AxiosError} from "axios";
import {useIonRouter} from "@ionic/vue";

const userStore = useUserStore();
const externalProviders = [
  {
    icon: logoFacebook,
  },
  {
    icon: logoGoogle
  }
]

const router = useIonRouter();
let userLoginData = reactive({'email' : '', password: '', loading: false});
const validationError = ref(null);
const login = async () => {
  try {
    userLoginData.loading = true;
    await userStore.login(userLoginData.email, userLoginData.password);
    router.push('/dashboard');

  }catch (axiosError : AxiosError){
    validationError.value = axiosError;
  }
  userLoginData.loading = false;
}
</script>
<template>
  <ion-page>
    <ion-content class="ion-padding" :fullscreen="true">
      <h1>{{$t('Login')}}</h1>
      <p>{{$t('Please sign in to your account')}}</p>
      <ion-item>
        <ion-icon aria-hidden="true" :icon="mailOutline" slot="start"></ion-icon>
        <ion-input
            :class="{'ion-invalid' : validationError?.getFirstError('email') != null}"
            class="ion-touched"
            :error-text="validationError?.getFirstError('email')"
            label-placement="floating"
            type="email" :label="$t('Email')"
            v-model="userLoginData.email"
            placeholder="john.dee@example.com"></ion-input>
      </ion-item>
      <ion-item>
        <ion-icon aria-hidden="true" :icon="lockClosed" slot="start"></ion-icon>
        <ion-input
            v-model="userLoginData.password"
            label-placement="floating"
            type="password"
            :label="$t('Password')"
            :class="{'ion-invalid' : validationError?.getFirstError('password') != null}"
            class="ion-touched"
            :error-text="validationError?.getFirstError('password')"></ion-input>
      </ion-item>
      <ion-button @click="login()" class="ion-margin-vertical" color="primary" shape="round" expand="full">{{ $t('Login') }}</ion-button>
      <ion-loading :is-open="userLoginData.loading" :message="$t('Please wait...')"></ion-loading>
      <Divider>{{$t('Or')}}</Divider>
      <ion-grid class="ion-margin-top">
        <ion-row class="ion-justify-content-center">
          <ion-col size="auto" v-for="provider in externalProviders">
            <ion-button style="width: 60px; height: 60px" color="light" shape="round" class="rounded-button icon-button">
              <ion-icon slot="icon-only" :icon="provider.icon"></ion-icon>
            </ion-button>
          </ion-col>
        </ion-row>
      </ion-grid>
    </ion-content>
  </ion-page>
</template>