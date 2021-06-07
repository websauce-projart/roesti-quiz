/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";
import Home from "./home.vue";

const home = createApp(Home);
home.mount("#home");
