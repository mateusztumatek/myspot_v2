<script setup lang="ts">

import {email, required} from "@/utilies/validations";
import {ref} from "vue";
import {useAxios} from "@vueuse/integrations/useAxios";
import {useUserStore} from "@/store/user";
import Request, {reportAxiosError} from "@/plugins/request";
import {AxiosError} from "axios";
import {useRouter} from "vue-router";
import LoginAsComponent from "@/components/Molecules/LoginAsComponent.vue";

const userStore = useUserStore();
const router = useRouter();
const {execute, error, isLoading, isFinished, response} = useAxios('/register', {method: 'POST'}, Request, {immediate: false});
const requestErrors = ref(null);
const form = ref(false);
const user = ref({
  name: '',
  email: '',
  password: '',
  password_confirmation: ''
});
const register = async () => {
  try {
    await execute({data: user.value})
    if(isFinished.value){
      userStore.setUser(response.value);
      router.push('/dashboard');
    }
  }catch (error : AxiosError){
    reportAxiosError(error);
  }
}
</script>
<template>
  <div class="d-flex align-center justify-center flex-column">
    <v-sheet width="400" class="mx-auto">
      <v-form fast-fail @submit.prevent="register()">
        <v-text-field :error-messages="error?.validationError?.getErrors('name')"
                      :loading="isLoading" v-model="user.name" :label="$t('user.name')"
                      type="email"></v-text-field>
        <v-text-field :error-messages="error?.validationError?.getErrors('email')"
                      :loading="isLoading" v-model="user.email" :label="$t('user.user_email')"
                      type="email"></v-text-field>
        <v-text-field :error-messages="error?.validationError?.getErrors('password')"
                      :loading="isLoading" v-model="user.password" :label="$t('user.password')"
                      type="password"></v-text-field>
        <v-text-field :error-messages="error?.validationError?.getErrors('password_confirmation')"
                      :loading="isLoading" v-model="user.password_confirmation" :label="$t('user.password')"
                      type="password"></v-text-field>
        <router-link to="forget-password" class="text-body-2 font-weight-regular">{{ $t('user.forget_password') }}</router-link>
        <v-btn :loading="isLoading" type="submit" color="primary" block class="mt-2">{{ $t('user.sign_in') }}</v-btn>
      </v-form>
      <div class="mt-2">
        <p class="text-body-2">{{$t('user.dont_have_account')}}
          <router-link to="/login">{{$t('user.login')}}</router-link>
        </p>
      </div>
    </v-sheet>
    <div class="w-100">
      <LoginAsComponent></LoginAsComponent>
    </div>
  </div>
</template>