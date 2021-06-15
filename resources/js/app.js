/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";

import CardsApp from "./cardsApp";
import Home from "./pages/home.vue";
import NewGame from "./pages/new_game.vue";
import Timer from "./components/Timer.vue";
import { create } from "lodash";
import GameButtons from "./components/gameButtons";

//When loaded, checks the service worker in the navigator
window.onload = () => {
	'use strict';

	if ('serviceWorker' in navigator) {
	  navigator.serviceWorker
			   .register('./sw.js');
	}
  }

const app = createApp({
	components: {
		CardsApp,
	},
}).mount("#cards");

const home = createApp({
	components: {
		Home
	},
}).mount("#vue_home");

const newGame = createApp({
	components: {
		NewGame,
	},
}).mount("#vue_new_game");

const timer = createApp({
	components: {
		Timer,
	}
}).mount("#timer");


const gameButtons = createApp({
	components:{
		GameButtons,
	},

}).mount('#vue_game_buttons')



