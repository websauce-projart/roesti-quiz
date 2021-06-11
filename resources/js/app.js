/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";
import CardsApp from "./cardsApp";
import Home from "./pages/home.vue";
import NewGame from "./pages/new_game.vue";
import GameButtons from "./components/GameButtons.vue";


const app = createApp({
    components: {
		CardsApp,
    },

  }).mount('#cards');

// const results = createApp(Results);
// home.mount("#results");

const home = createApp({
    components: {
      Home,
    },
  }).mount('#vue_home')

const newGame = createApp({
  components: {
    NewGame
  },
}).mount('#vue_new_game')

const gameButtons = createApp({
	components:{
		GameButtons,
	},

	mounted(){
		console.log('carabistouilles');
	}

}).mount('#vue_game_buttons')



