<script lang="ts" setup>
import {reactive, ref, nextTick} from "vue";

import router from "@/router";

import {useLoadingStore} from "@/store/loading";

import {required, email} from "@/utilies/validations";

import {useUserStore} from '@/store/user';
import {useAlertsStore} from "@/store/alerts";
import {RequestError} from "@/plugins/requestError";

const loadingStore = useLoadingStore()
const alertStore = useAlertsStore()
const userStore = useUserStore();

const form = ref(null);
const user = ref({
  email: '',
  password: ''
})


let requestErrors = ref(null);
/**
 * Asynchronous function to handle user login
 */
const login = async () => {
  // Reset request errors
  requestErrors.value = null;

  // Wait for next tick
  await nextTick();

  // Check if form is valid
  if (form.value) {
    // Start loading
    loadingStore.startLoading();

    // Attempt user login
    try {
      const res = await userStore.login(user.value.email, user.value.password);
      // Stop loading and redirect to dashboard on successful login
      loadingStore.stopLoading();
      router.push('dashboard');
    } catch (error) {
      // Set request error and stop loading on login error
      if (error) {
        requestErrors.value = error;
      }
      loadingStore.stopLoading();
    }
  }
}

</script>
<template>
  <div class="d-flex align-center justify-center">
    <v-sheet width="400" class="mx-auto">
      <v-form v-model="form" fast-fail @submit.prevent="login()">
        <v-text-field :error-messages="requestErrors? requestErrors.getErrors('email') : []" :rules="[required, email]"
                      :loading="loadingStore.isLoading" v-model="user.email" :label="$t('user.user_email')"
                      type="email"></v-text-field>
        <v-text-field :error-messages="requestErrors? requestErrors.getErrors('password') : []" :rules="[required]"
                      :loading="loadingStore.isLoading" v-model="user.password" :label="$t('user.password')"
                      type="password"></v-text-field>
        <router-link to="forget-password" class="text-body-2 font-weight-regular">{{ $t('user.forget_password') }}</router-link>
        <v-btn :loading="loadingStore.isLoading" type="submit" color="primary" block class="mt-2">{{ $t('user.sign_in') }}</v-btn>
      </v-form>
      <div class="mt-2">
        <p class="text-body-2">{{$t('user.dont_have_account')}}
          <router-link to="signup">{{$t('user.sign_up')}}</router-link>
        </p>
      </div>
    </v-sheet>
  </div>
</template>