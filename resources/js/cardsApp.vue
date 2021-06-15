<template>
	<div id="cardscontainer">
		<GameCardsStack
			:cards="visibleCards"
			:qid="qid"
			@hideCard="removeCardFromDeck"
			@reject="SwipeLeft"
			@accept="SwipeRight"
			@cardAccepted="handleCardAccepted"
			ref="gCStack"
		/>
	</div>
</template>

<script>
import GameCardsStack from "./components/GameCardsStack";


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
	  /**
		* @method handleCardAccepted is called through
		* child-fired @event cardAccepted
		* It checks the question-related checkbox
	   */
    handleCardAccepted() {
		document.getElementById(this.qid[0]).checked = true;
    },

	 /**
	  * shifts arrays to ensure we are not working on
	  * an already treated card
	  * then submits form when the last card is flipped
	  */
    removeCardFromDeck() {
      this.visibleCards.shift();
		this.qid.shift();
		let testEmpty= [];
		if(this.qid.length === testEmpty.length){
			document.getElementById('quizForm').submit();
		}
    },

	 /**
	  * creates arrays and populates them
	  * with the cards info in order to pass the recieved
	  * props datas to the child component
	  */
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

	  /**
		* when @event reject is recieved,
		* @function SwipeLeft is called
		* and calls child @function stackReject through refs
	   */
	  SwipeLeft(){
		  this.$refs.gCStack.stackReject();
	  },

	  /**
		* when @event accept is recieved,
		* @function Swiperight is called
		* and calls child @function stackAccept through refs
	   */
	  SwipeRight(){
		  this.$refs.gCStack.stackAccept();
	  },

  },

  created() {
	  this.createQuestionsArray();
  },

};
</script>

<style>
#cardscontainer {
	text-align: center;
}

.cards-container {
	display: block;
	width: 30rem;
	margin: auto;
	margin-top: var(--margin-l);
}

.card {
	box-shadow: var(--boxshadow-card);
	transition: 0.3s;
	border-radius: 5px; /* 5px rounded corners */
	background: var(--color-white);
	border-radius: var(--borderradius-m);
	padding: var(--margin-m);
	display: flex;
	height: 20rem;
	width: 30rem;
	justify-content: center;
	align-items: center;
	position: absolute;
	margin-top: 3rem;
	pointer-events: none;
}

@media (max-width: 768px) {
	.cards {
		display: flex;
		justify-content: center;
	}
	.card {
		padding: var(--margin-m);
		width: 17rem;
		height: 22rem;
	}
	.card .cardTitle {
		font-size: var(--fontsize-l);
	}
}

.cardTitle {
	font-family: var(--font-text);
	font-size: var(--fontsize-ll);
	font-weight: 300;
}

.card,
.card * {
	-ms-touch-action: none;
	touch-action: none;
}

.isCurrent {
	margin-top: 1rem;
}

.a0 {
	z-index: 10;
	pointer-events: auto;
}

.a1 {
	z-index: 9;
	margin-top: 2rem;
}

.a2 {
	z-index: 8;
}

.a3 {
	z-index: 7;
}

.a4 {
	z-index: 6;
}

.a5 {
	z-index: 5;
}

.a6 {
	z-index: 4;
}

.a7 {
	z-index: 3;
}

.a8 {
	z-index: 2;
}

.a9 {
	z-index: 1;
}
</style>
