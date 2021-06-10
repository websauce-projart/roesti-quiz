/********************************
 * App JS
 ********************************/
require("./bootstrap");

import { createApp } from "vue";
import MainNavButton from "./components/mainnav/MainNavButton.vue";
import MainNavContent from "./components/mainnav/MainNavContent.vue";

import CardsApp from "./cardsApp";
import Home from "./pages/home.vue";
import NewGame from "./pages/new_game.vue";

const mainNav = createApp({
	components: {
		MainNavButton,
		MainNavContent,
	},
}).mount("#main-nav");

const home = createApp({
	components: {
		Home,
	},
}).mount("#vue_home");

const newGame = createApp({
	components: {
		NewGame,
	},
}).mount("#vue_new_game");
