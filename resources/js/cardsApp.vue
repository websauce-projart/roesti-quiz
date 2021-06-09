<template>
  <div id="penislol">
		<GameCardsStack
			:cards="visibleCards"
			@cardAccepted="handleCardAccepted"
			@cardRejected="handleCardRejected"
			@cardSkipped="handleCardSkipped"
			@hideCard="removeCardFromDeck"
		/>
  </div>
</template>

<script>
import GameCardsStack from "./components/GameCardsStack";

export default {
  name: "CardsApp",
  components: {
    GameCardsStack

  },

  data() {
    return {
      visibleCards: ["Test", "pouet", "chapeau", "yolo", "une de plus"]
    };
  },


  methods: {
    handleCardAccepted() {
      console.log("handleCardAccepted");
    },
    handleCardRejected() {
      console.log("handleCardRejected");
    },
    handleCardSkipped() {
      console.log("handleCardSkipped");
    },
    removeCardFromDeck() {
      this.visibleCards.shift();
    }
  }
};
</script>

<style>


#Penislol {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  text-align: center;
}
</style>
