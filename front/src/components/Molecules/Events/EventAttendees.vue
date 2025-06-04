<template>
  <div>
    <div class="font-weight-bold">Attendees</div>
    <div class="d-flex justify-center">
      <v-progress-circular class="my-4" :indeterminate="true" v-if="isLoading" />
      <div :key="attendee.id"
           v-for="attendee in attendees?.data">
        <v-avatar
            class="elevation-4"
            color="primary"
            size="large"
        >
          <v-img v-if="attendee?.attendee_avatar" :src="attendee.attendee_avatar" />
          <span v-else class="text-h6 font-weight-bold">{{ getInitialFromName(attendee?.attendee_name ?? '') ?? getInitialFromEmail(attendee?.attendee_email) }}</span>
        </v-avatar>
      </div>
    </div>
  </div>
</template>
<script lang="ts" setup>
import {EventAttendee, EventInterface} from "@/types/events";
import {defineProps} from 'vue';
import {useAxios} from "@vueuse/integrations/useAxios";
import Request from "@/plugins/request";
import {LaravelResourcePaginated} from "@/types/laravel";
const props = defineProps<{
  event: EventInterface
}>();

const getInitialFromName = (name : string) : string => {
  if (!name) return '';
  const parts = name.split(' ');
  if (parts.length === 1) {
    return parts[0].charAt(0).toUpperCase();
  }
  return parts[0].charAt(0).toUpperCase() + parts[1].charAt(0).toUpperCase();
}

const getInitialFromEmail = (email : string) : string => {
  if (!email) return '';
  const parts = email.split('@');
  if (parts.length === 0) return '';
  const namePart = parts[0];
  return namePart.charAt(0).toUpperCase();
}

const {execute, isLoading, error, isFinished, response: attendees} = useAxios<any, LaravelResourcePaginated<EventAttendee>>(
  `/api/events/${props.event.uuid}/attendees`,
  {method: 'GET'},
    Request,
  {
    immediate: true
  }
);
</script>