<script lang="ts" setup>
  import Logo from "@/assets/logo-black.svg";
</script>
<template>
    <div class="w-100 d-flex flex-column align-center">
        <v-img width="200px" :src="Logo"></v-img>
        <router-view></router-view>
    </div>
</template>