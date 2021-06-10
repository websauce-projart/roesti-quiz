<template>
  <div class="cards">
    <GameCard
      v-for="(card, index) in cards"
      :key="card"
      :card="card"
      :qid="qid[index]"
      :is-current="index === 0"
      :class="'a' + index"
      @cardAccepted="$emit('cardAccepted')"
      @cardRejected="$emit('cardRejected')"
      @cardSkipped="$emit('cardSkipped')"
      @hideCard="$emit('hideCard')"

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

  mounted() {},
};
</script>

<style>
.a0 {
  z-index: 10;
}

.a1 {
  z-index: 9;
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

.cards {
  color: red;
}
</style>
