/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";
import CardsApp from "./cardsApp";
import Home from "./pages/home.vue";
import NewGame from "./pages/new_game.vue";



/*const app = createApp({
    components: {
      Home,
		CardsApp
    },

  }).mount('#app');*/

// const results = createApp(Results);
// home.mount("#results");

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