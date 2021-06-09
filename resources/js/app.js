/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";
import Home from "./pages/home.vue";
import NewGame from "./pages/new_game.vue";

const home = createApp({
    components: {
      Home
    },
  }).mount('#vue_home')

const newGame = createApp({
  components: {
    NewGame
  },
}).mount('#vue_new_game')