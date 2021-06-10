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
      @cardSkipped="$emit('cardSkipped')"
      @hideCard="$emit('hide-card')"
		:qid="qid[index]"
    >
    </GameCard>
  </div>
</template>
<script>
import GameCard from "./GameCard";

export default {
  components: {
    GameCard,
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
};
</script>

<style>


.cards {
  color: red;
}
</style>
