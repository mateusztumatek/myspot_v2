<template>
  <div class="divider">
    <slot></slot>
  </div>
</template>

<style lang="scss">
.divider {
  display: flex;
  align-items: center;
  &:after, &:before{
    flex: 1;
    content: '';
    padding: 0.5px;
    background-color: var(--ion-text-color);
    margin: 5px;
  }
}
</style>
<script setup lang="ts">
</script>