/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";
import hello from "./HelloWorld.vue";


const app = createApp({
    components: {
        hello,
    }
}).mount("#app");
