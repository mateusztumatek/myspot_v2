<script type="ts" setup>
  import {useTheme} from "vuetify";
  import {useDark} from "@vueuse/core";

  const theme = useTheme();
  let isDark = useDark({
    onChanged : (isDark) => {
      theme.global.name.value = isDark ? 'dark' : 'light';
    }
  });


</script>
<template>
  <div class="theme-switcher">
    <v-switch
        true-icon="mdi-weather-night"
        false-icon="mdi-weather-sunny"
        :true-value="true"
        :false-value="false"
        inset
        v-model="isDark"></v-switch>
  </div>
</template>

<style lang="scss">
  .theme-switcher{
    position: fixed;
    top: 0px;
    right: 0px;
    padding: 10px;
  }
</style>

