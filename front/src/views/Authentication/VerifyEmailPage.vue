<script setup type="ts">
  import {useUserStore} from "@/store/user";
  import {ref} from "vue";
  import UseRequest from "@/plugins/useRequest";
  let loading = ref(false);
  const logout = async () => {
      loading.value = true;
      await userStore.logout();
      loading.value = false;
  }
  const ResendConfirmationRequest = UseRequest('/email/verification-notification', 'post');
  const userStore = useUserStore();
  const dialog = true;
</script>
<template>
  <div>
    <v-dialog width="500" v-model="dialog" persistent>
      <template v-slot:default>
        <v-card title="Dialog">
          <v-card-text>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn
                variant="elevated"
                color="primary"
                text="Resend confirmation email"
                @click="ResendConfirmationRequest.fetchData()"
                :loading="ResendConfirmationRequest.loading.value"
            ></v-btn>
            <v-btn
                variant="elevated"
                color="primary"
                text="Logout"
                :loading="loading"
                @click="logout"
            ></v-btn>
          </v-card-actions>
        </v-card>
      </template>
    </v-dialog>
  </div>
</template>