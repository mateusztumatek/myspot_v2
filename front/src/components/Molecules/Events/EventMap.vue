<template>
  <v-sheet
      v-if="mapData"
      class="d-flex justify-end flex-wrap text-center mx-auto position-relative"
      elevation="8"
      height="300"
      width="100%"
      rounded
  >
    <MapComponent :lat="(mapData.lat as number)" :lng="(mapData.lng as number)" />
    <v-btn color="light-blue-darken-2" icon="mdi-navigation-variant" elevation="8" :style="{bottom: '25px', right: '20px', zIndex: 2}" class="" absolute></v-btn>
  </v-sheet>
</template>
<script setup lang="ts">
import MapComponent from "@/components/MapComponent.vue";
import {computed, defineProps} from "vue";
import {EventInterface} from "@/types/events";

const props = defineProps<{
  event: EventInterface
}>();

const mapData = computed(() : {lat: number, lng: number} | null=> {
  // Adjust property names based on your API response structure
  if(!props.event || !props.event.location_latitude || !props.event.location_longitude) {
    return null;
  }
  const lat = props.event.location_latitude;
  const lng = props.event.location_longitude;
  return {lat, lng}
});
</script>