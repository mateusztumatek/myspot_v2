<template>
  <div>
    <v-skeleton-loader
        v-if="isLoading"
        class="mx-auto my-4"
        elevation="2"
        type="card-avatar, article, actions"
        boilerplate
    ></v-skeleton-loader>
    <div v-if="event">
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
      <v-container>
        <div class="my-8">
          <div class="text-body-2 mb-2 text-primary">Event Title</div>
          <div class="text-h4 font-weight-bold">{{event.name}}</div>
        </div>
        <v-divider></v-divider>
        <v-row justify="space-between" class="my-4">
          <v-col cols="6">
            <div class="w-100 h-100">
              <div class="d-flex justify-space-between align-center w-100 bg-grey-darken-3 rounded-lg pa-3 h-100">
                <span class="text-caption">{{date.format(event.start_at, 'keyboardDateTime') || '-'}}</span>
                <v-icon icon="mdi-calendar" />
              </div>
            </div>
          </v-col>
          <v-col cols="6">
            <div class="w-100 h-100">
              <div class="d-flex justify-space-between align-center w-100 bg-grey-darken-3 rounded-lg pa-3 h-100">
                <span class="text-caption">{{event.end_at ? date.format(event.end_at, 'keyboardDateTime') : '-'}}</span>
                <v-icon icon="mdi-calendar" />
              </div>
            </div>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" class="font-weight-bold">
            Additional Information
          </v-col>
          <v-col cols="12">
            <div class="text-grey rich-text-output rich-text-content" v-html="event.description"></div>
          </v-col>
        </v-row>
      </v-container>
    </div>
  </div>
</template>
<script lang="ts" setup>

import {useAxios} from "@vueuse/integrations/useAxios";
import Request from "@/plugins/request";
import {useRoute} from "vue-router";
import {computed} from "vue";
import MapComponent from "@/components/MapComponent.vue";
import {useDate} from "vuetify/framework";

const date = useDate();
// Get the event ID from the route parameters
let route = useRoute();
let eventId = route.params.uuid;

let {execute, isLoading, error, isFinished, response : event} = useAxios<any, {
  id: string;
  name: string;
  description: string;
  location_latitude: number | null;
  location_longitude: number | null;
  start_time: string;
  end_time: string;
  created_at: string;
  updated_at: string;
}>("/api/events/"+eventId, {method: 'GET'}, Request,{
  immediate: true
});

const mapData = computed(() => {
  // Adjust property names based on your API response structure
  if(!event.value) {
    return null;
  }
  const lat = event.value.location_latitude;
  const lng = event.value.location_longitude;
  return {lat, lng}
});


</script>
<style lang="scss">
.rich-text-output {
  font-family: Roboto, sans-serif;
  color: rgba(0, 0, 0, 0.87); /* match Vuetify base text color */
  line-height: 1.6;
  font-size: 1rem;
}

.rich-text-output h1 {
  font-size: 2.125rem;
  margin: 1.2rem 0 0.6rem;
  font-weight: 500;
}

.rich-text-output h2 {
  font-size: 1.5rem;
  margin: 1rem 0 0.5rem;
  font-weight: 500;
}

.rich-text-output p {
  margin: 0.8rem 0;
}

.rich-text-output ul,
.rich-text-output ol {
  padding-left: 1.5rem;
  margin: 0.8rem 0;
}

.rich-text-output li {
  margin-bottom: 0.5rem;
}

.rich-text-output blockquote {
  margin: 1rem 0;
  padding: 0.8rem 1rem;
  border-left: 4px solid #ccc;
  background-color: #f9f9f9;
  font-style: italic;
}

.rich-text-output a {
  color: #1976d2;
  text-decoration: underline;
}

.rich-text-output strong {
  font-weight: 600;
}
</style>