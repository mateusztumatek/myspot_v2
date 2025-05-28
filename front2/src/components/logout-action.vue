<template>
  <div>
    <slot :logout="logout"></slot>
    <ion-loading :is-open="loading"></ion-loading>
  </div>
</template>
<script lang="ts" setup>

  import {IonLoading} from "@ionic/vue";
  import {defineEmits, ref} from 'vue';
  import {useUserStore} from "@/store/user";
  import {useIonRouter} from "@ionic/vue";
  const router = useIonRouter();

  const userStore = useUserStore();
  const emit = defineEmits(['afterLogout'])
  const loading = ref(false);
  const logout = async() => {
    loading.value = true;
    await userStore.logout();
    loading.value = false;
    emit('afterLogout');
    router.push('/login');
  }
</script>