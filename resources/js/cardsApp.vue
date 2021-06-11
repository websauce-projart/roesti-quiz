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
let emitter = require('tiny-emitter/instance');
emitter.on("buttonRejected", console.log("GNEU"));

export default {
  name: "CardsApp",
  components: {
    GameCardsStack,
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
		document.getElementById(this.qid[0]).checked = true;
    },
    handleCardRejected() {
      console.log("handleCardRejected");
    },
    handleCardSkipped() {
      console.log("handleCardSkipped");
    },
    removeCardFromDeck() {
      this.visibleCards.shift();
		this.qid.shift();
		let test= [];
		if(this.qid.length === test.length){
			document.getElementById('quizForm').submit();
		}
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
	  },

	  SwipeLeft(){
		  console.log("Ok, on lance à gauche!");
	  },

	  SwipeRight(){
		  console.log("Ok, on lance a droite!");
	  },

  },

  created() {
	  this.createQuestionsArray();
  },

  mounted(){
  }

};
</script>

<style>


#cardscontainer {
  font-family: "Avenir", Helvetica, Arial, sans-serif;
  text-align: center;
}
</style>
