<script setup lang="ts">
  import {defineProps} from "vue";
  defineProps({
    name: String,
    icon: String,
    url: String
  });
</script>
<template>
  <div class="d-flex flex-column align-center">
    <v-btn icon color="grey" :href="url">
      <v-img :src="icon" width="25px" height="25px"></v-img>
    </v-btn>
    <div class="mt-1 text-caption">{{name}}</div>
  </div>
</template>