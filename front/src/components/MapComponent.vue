<template>
  <div class="w-100">
    <GoogleMap
        :api-key="GOOGLE_MAPS_API_KEY"
        style="width: 100%; height: 300px;"
        :center="center"
        color-scheme="DARK"
        map-id="922e935608e676bf5618eb24"
        :zoom="15"
        :map-type-control="false"
        :fullscreen-control="false"
        :draggable="false"
        :camera-control="false"
        :street-view-control="false"
        :clickable-icons="false"
    >
      <CustomMarker :options="{ position: center }">
        <img :src="require('@/assets/marker.png')" alt="Marker" style="width: 20px;">
      </CustomMarker>
    </GoogleMap>
  </div>
</template>
<script lang="ts" setup>
import {onMounted, defineProps, ref, computed} from 'vue';
import {GoogleMap, Marker, CustomMarker} from "vue3-google-map";
// Load google maps api script if not loaded yet
const GOOGLE_MAPS_API_KEY = "AIzaSyAM5a0uyBuBtfeC6VHJmws45S3T_-jCAzM";

const props = defineProps<{
  lat: number;
  lng: number;
}>();

const center = computed(() => {
  return {
    lat: parseFloat(Number(props.lat).toFixed(6)),
    lng: parseFloat(Number(props.lng).toFixed(6))
  };
});

// Dark theme style array
const darkMapStyle = [
  { elementType: "geometry", stylers: [{ color: "#212121" }] },
  { elementType: "labels.icon", stylers: [{ visibility: "off" }] },
  { elementType: "labels.text.fill", stylers: [{ color: "#757575" }] },
  { elementType: "labels.text.stroke", stylers: [{ color: "#212121" }] },
  { featureType: "administrative", elementType: "geometry", stylers: [{ color: "#757575" }] },
  { featureType: "landscape", elementType: "geometry", stylers: [{ color: "#1a1a1a" }] },
  { featureType: "poi", elementType: "geometry", stylers: [{ color: "#1a1a1a" }] },
  { featureType: "road", elementType: "geometry", stylers: [{ color: "#2c2c2c" }] },
  { featureType: "water", elementType: "geometry", stylers: [{ color: "#000000" }] }
];


</script>
<style lang="scss">
.gmnoprint{
  display: none !important;
}
// display none for image with alt Google
.img[alt="Google"] {
  display: none !important;
}
</style>