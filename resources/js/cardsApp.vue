<template>
  <div id="cardscontainer">
		<GameCardsStack
			:cards="visibleCards"
			:qid="qid"
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
      visibleCards: [],
		qid: Array,
    };
  },

  props: {
	  datas: Object,
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
    },

	 createQuestionsArray(){
		 let datas = this.$props.datas;
		 let labels = [];
		 let ids = [];

		for (let index in datas) {
       labels.push(datas[index].label);
		 ids.push(datas[index].id);
      }

		this.visibleCards = labels;
		this.qid = ids;
	  }

  },

  created() {
	  this.createQuestionsArray();
  },
};
</script>

<style>


#cardscontainer {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  text-align: center;
}
</style>
