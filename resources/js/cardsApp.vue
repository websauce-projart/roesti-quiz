<template>
  <div id="cardscontainer">
		<GameCardsStack
			:cards="visibleCards"
			:qid="qid"
			@hideCard="removeCardFromDeck"
			@reject="SwipeLeft"
			@accept="SwipeRight"
			ref="gameCardStack"
		/>
  </div>
</template>

<script>
import GameCardsStack from "./components/GameCardsStack";
import GameCard from './components/GameCard.vue';


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
		  this.$refs.gameCardStack.testReject();


	  },

	  SwipeRight(){
		  this.$refs.gameCardStack.testAccept();
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
