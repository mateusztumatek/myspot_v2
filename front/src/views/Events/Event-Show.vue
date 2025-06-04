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
      <EventMap :event="event"/>
      <v-container>
        <EventDetails :event="event" />
      </v-container>
      <v-container>
        <EventAttendees :event="event" />
      </v-container>
      <EventFooter :event="event" />
    </div>
  </div>
</template>
<script lang="ts" setup>

import {useAxios} from "@vueuse/integrations/useAxios";
import Request from "@/plugins/request";
import {useRoute} from "vue-router";
import {EventInterface} from "@/types/events";
import EventMap from "@/components/Molecules/Events/EventMap.vue";
import EventDetails from "@/components/Molecules/Events/EventDetails.vue";
import EventAttendees from "@/components/Molecules/Events/EventAttendees.vue";
import SwapableButton from "@/components/Atoms/SwapableButton.vue";
import EventFooter from "@/components/Molecules/Events/EventFooter.vue";

// Get the event ID from the route parameters
let route = useRoute();
let eventId = route.params.uuid;

let {execute, isLoading, error, isFinished, response : event} = useAxios<any, EventInterface>("/api/events/"+eventId, {method: 'GET'}, Request,{
  immediate: true
});
</script>