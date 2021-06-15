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
      :ref="
        (el) => {
          if (el) divs[index] = el;
        }
      "
    >
    </GameCard>

    <GameButtons @reject="$emit('reject')" @accept="$emit('accept')" />
  </div>
</template>
<script>
import GameCard from "./GameCard";
import GameButtons from "./GameButtons.vue";
import { ref, onBeforeUpdate } from "vue";

export default {
  components: {
    GameCard,
    GameButtons,
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
  setup() {
    const divs = ref([]);

    onBeforeUpdate(() => {
      divs.value = [];
    });

    function testReject() {
      divs.value[0].testReject();
    }
    function testAccept() {
      divs.value[0].testAccept();
    }

    return {
      testReject,
      testAccept,
      divs,
    };
  },
};
</script>
