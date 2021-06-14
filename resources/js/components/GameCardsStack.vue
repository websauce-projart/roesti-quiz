<template>
  <div class="cards">
    <GameCard
      v-for="(card, index) in cards"
      :key="card"
      :card="card"
      :is-current="index === 0"
      :class="'a' + index"
      @cardAccepted="$emit('cardAccepted')"
      @cardRejected="$emit('cardRejected')"
      @hideCard="$emit('hide-card')"
		:qid="qid[index]"
		:id="index"
		ref="gameCard"
    >
    </GameCard>
	<GameButtons
	 @reject="$emit('reject')"
	 @accept="$emit('accept')"
	 />
  </div>

</template>
<script>
import GameCard from "./GameCard";
import GameButtons from"./GameButtons.vue"

export default {
  components: {
    GameCard,
	 GameButtons
  },
    data() {
    return {
      indexId: 0,
    };
  },

  props: {
    cards: {
      type: Array,
      required: true,
    },
    qid: {
      type: Array,
      required: true,
    },
  },

  methods:{
	  testReject(){
		  console.log('methode test reject dans GameCardsStack');
		  this.$refs.gameCard.testReject();
	  },
	   testAccept(){
		  console.log('methode test accept dans GameCardsStack');
		  this.$refs.gameCard.testAccept();
	  }
  },
};
</script>

<style>


.cards {
  color: red;
}
</style>
