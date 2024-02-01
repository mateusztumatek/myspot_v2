<script setup lang="ts">
  import {required, email as emailValidationRule} from "@/utilies/validations";
  import {ref} from "vue";
  import Request from "@/plugins/request";
  import {useAxios} from "@vueuse/integrations/useAxios";
  import {useAlertsStore} from "@/store/alerts";
  import {$t} from "@/plugins/i18n";
  import {tr} from "vuetify/locale";
  import {AxiosError} from "axios";
  import {useRoute, useRouter} from "vue-router";

  const alertStore = useAlertsStore();
  const route = useRoute();
  const { push } = useRouter();
  let password = ref(null);
  let password_confirmation = ref(null);
  let {data, execute, isLoading, error, isFinished} = useAxios('/reset-password', {method: 'POST'}, Request,{
    immediate: false
  });

  let submit = async () => {
    try{
      await execute({data:
            {
              password: password.value,
              password_confirmation: password_confirmation.value,
              token: route.query.token,
              email: route.query.email
            }
      });
      if(isFinished.value){
        alertStore.addAlert('Success', $t('user.reset_password_message'), 5000, 'success');
        push('/login');
      }
    }catch (e: AxiosError){
      if(e.validationError){
        alertStore.addAlert('Error', e.validationError.getMessage(), 5000, 'error');
      }
    }
  }
</script>

<template>
  <div class="container">
    <v-form @submit.prevent="submit()" :loading="isLoading">
      <v-text-field type="password" :error-messages="error?.validationError?.getErrors('password')" :label="$t('user.password')" v-model="password"></v-text-field>
      <v-text-field type="password" :error-messages="error?.validationError?.getErrors('password_confirmation')" :label="$t('user.password_confirmation')" v-model="password_confirmation"></v-text-field>
      <v-btn type="submit" :loading="isLoading" color="primary" :text="$t('user.set_new_password')"></v-btn>
    </v-form>
  </div>
</template>