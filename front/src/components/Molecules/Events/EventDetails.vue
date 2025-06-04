<template>
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
            <v-icon icon="mdi-calendar"/>
          </div>
        </div>
      </v-col>
      <v-col cols="6">
        <div class="w-100 h-100">
          <div class="d-flex justify-space-between align-center w-100 bg-grey-darken-3 rounded-lg pa-3 h-100">
            <span class="text-caption">{{event.end_at ? date.format(event.end_at, 'keyboardDateTime') : '-'}}</span>
            <v-icon icon="mdi-calendar"/>
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
</template>
<script lang="ts" setup>
import {defineProps} from 'vue'
import {EventInterface} from "@/types/events";
import {useDate} from "vuetify/framework";

const date = useDate();
const props = defineProps<{
  event : EventInterface;
}>();

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