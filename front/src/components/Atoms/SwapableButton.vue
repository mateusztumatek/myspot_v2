<template>
  <div
      class="swipe-container"
      @mousedown="startDrag"
      @mousemove="onDrag"
      @mouseup="endDrag"
      @mouseleave="endDrag"
      @touchstart="startDrag"
      @touchmove="onDrag"
      @touchend="endDrag"
  >
    <div class="swipe-track">
      <div class="swipe-progress" :style="{ width: `${dragX+20}px` }" />

      <v-btn
          :loading="loading"
          color="primary"
          class="swipe-button"
          :style="{ left: `${dragX}px` }"
          elevation="5"
          @click.stop
      >
        ▶
      </v-btn>

      <div class="swipe-label">Swipe to sign-up</div>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref, defineEmits, defineExpose} from 'vue'

const dragging = ref(false)
const dragX = ref(0)
const startX = ref(0)
const maxSwipe = 250 // max swipe length in px

const emit = defineEmits<{
  (event: 'swipe-confirmed'): void;
}>();

const loading = ref(false);

function startDrag(event) {
  if(loading.value) return;
  dragging.value = true
  startX.value = event.type.includes('touch')
      ? event.touches[0].clientX
      : event.clientX
}

function onDrag(event) {
  if(loading.value) return;
  if (!dragging.value) return
  const currentX = event.type.includes('touch')
      ? event.touches[0].clientX
      : event.clientX
  const distance = currentX - startX.value
  dragX.value = Math.max(0, Math.min(distance, maxSwipe))
}

function endDrag() {
  if (!dragging.value) return
  if (dragX.value >= maxSwipe - 10) {
    loading.value = true;
    emit('swipe-confirmed');
    return;
  }
  dragging.value = false
  dragX.value = 0
}

const resetSwipe = () => {
  dragging.value = false
  dragX.value = 0
  loading.value = false;
}

defineExpose({
  resetSwipe
})
</script>

<style scoped>
.swipe-container {
  width: 300px;
  margin: 20px auto;
  user-select: none;
  touch-action: pan-x;
}

.swipe-track {
  position: relative;
  background-color: #e0e0e0;
  border-radius: 32px;
  height: 48px;
  overflow: hidden;
}

/* ✅ Background progress color */
.swipe-progress {
  position: absolute;
  height: 100%;
  background: linear-gradient(-45deg, #2196f3, #21cbf3, #0d47a1, #1e88e5);
  background-size: 400% 400%;
  animation: oceanFlow 15s ease infinite;
  border-radius: 32px 0 0 32px;
  z-index: 1;
}

@keyframes oceanFlow {
  0% {
    background-position: 0% 50%;
  }
  50% {
    background-position: 100% 50%;
  }
  100% {
    background-position: 0% 50%;
  }
}

/* 🔘 Movable button */
.swipe-button {
  position: absolute;
  top: 0;
  height: 100%;
  min-width: 48px;
  border-radius: 32px;
  z-index: 2;
}

/* 🏷️ Label text */
.swipe-label {
  position: absolute;
  width: 100%;
  height: 100%;
  text-align: center;
  line-height: 48px;
  font-weight: 500;
  color: #555;
  pointer-events: none;
  z-index: 0;
}
</style>
