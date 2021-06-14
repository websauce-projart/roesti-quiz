<template>
  <div>
    <p>{{ formattedElapsedTime }}</p>
  </div>
</template>

<script>
import { computed, ref } from 'vue';
export default {
  setup() {
    let elapsedTime = ref(0);
    let timer = undefined;

    const formattedElapsedTime = computed(() => {
      const date = new Date(null);
      date.setSeconds(elapsedTime.value / 1000);
      const utc = date.toUTCString();
      return utc.substr(utc.indexOf(":") - -1, 5);
    });

    function start() {
        timer = setInterval(() => {
          elapsedTime.value += 1000;
        }, 1000);
    }

    start();
    return {formattedElapsedTime}
  }
};
</script>