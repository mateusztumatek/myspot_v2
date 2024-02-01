<script setup lang="ts">
  import {required, email as emailValidationRule} from "@/utilies/validations";
  import {ref} from "vue";
  import Request from "@/plugins/request";
  import {useAxios} from "@vueuse/integrations/useAxios";
  import {useAlertsStore} from "@/store/alerts";
  import {$t} from "@/plugins/i18n";
  import {tr} from "vuetify/locale";
  import {AxiosError} from "axios";

  const alertStore = useAlertsStore();
  let email = ref(null);
  let {data, execute, isLoading, error, isFinished} = useAxios('/forgot-password', {method: 'POST'}, Request,{
    immediate: false
  });

  let submit = async () => {
    try{
      await execute({data: {email: email.value}});
      if(isFinished.value){
        alertStore.addAlert('', $t('user.sent_new_password_email'), 5000, 'success');
      }
    }catch (e: AxiosError){
      if(e.validationError){
        alertStore.addAlert('', e.validationError.getMessage(), 5000, 'error');
      }
    }
  }
</script>

<template>
  <div class="container">
    <v-form @submit.prevent="submit()" :loading="isLoading">
      <v-text-field :error-messages="error?.validationError?.getErrors('email')" :label="$t('user.email')" v-model="email"></v-text-field>
      <v-btn type="submit" :loading="isLoading" color="primary" :text="$t('user.reset_password')"></v-btn>
    </v-form>
  </div>
</template>