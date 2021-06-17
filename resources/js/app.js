/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";

import CardsApp from "./cardsApp";
import Home from "./pages/home.vue";
import NewGame from "./pages/new_game.vue";
import Timer from "./components/Timer.vue";

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

//When loaded, checks the service worker in the navigator

window.onload = () => {
if ('serviceWorker' in navigator) {
 navigator.serviceWorker.register('/websauce/sw.js', { scope: '/websauce/' }).then(function(registration) {
//    console.log('Service worker registration succeeded:', registration);
 }).catch(function(error) {
//    console.log('Service worker registration failed:', error);
 });
  } else {
//  console.log('Service workers are not supported.');
  }
}
