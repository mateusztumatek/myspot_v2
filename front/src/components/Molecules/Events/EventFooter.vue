<template>
  <div class="position-fixed d-flex justify-space-between align-center bottom-0 left-0 right-0 w-100" style="height: 80px; z-index: 10; background-color: rgb(var(--v-theme-surface))">
    <v-container>
      <SwapableButton ref="swapButton" @swipe-confirmed="swipeCallback()" />
    </v-container>
  </div>
</template>
<script setup lang="ts">
import SwapableButton from "@/components/Atoms/SwapableButton.vue";
import {EventInterface} from "@/types/events";
import {defineProps, ref} from "vue";
import {useEventComposable} from "@/composable/eventComposable";

const {signToEvent} = useEventComposable();

const swapButton = ref<InstanceType<typeof SwapableButton> | null>('swapButton');

const props = defineProps<{
  event: EventInterface
}>();

const swipeCallback = async() => {
  try {
    await signToEvent(props.event)
  }catch (e) {
    console.error(e);
  } finally {
    swapButton.value.resetSwipe();
  }
};
</script>