/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";
import Home from "./home.vue";
import Results from "./results.vue";

const home = createApp(Home);
home.mount("#home");

const results = createApp(Results);
home.mount("#results");
