/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";
import Home from "./home.vue";

const app = createApp({
    components: {
      Home
    }
  }).mount('#app');

// const results = createApp(Results);
// home.mount("#results");
