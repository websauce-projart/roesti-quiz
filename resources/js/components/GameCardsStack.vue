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
    :ref="el => { if (el) divs[index] = el }"
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
import { ref , onBeforeUpdate } from 'vue'

export default {
  components: {
    GameCard,
	 GameButtons
  },
  props: {
	  /**
		* Is the array containing every card
		* and mark the first one as current
	   */
    cards: {
      type: Array,
      required: true,
    },
	 /**
	  * Array containing the questions ID
	  */
    qid: {
      type: Array,
      required: true,
    },
  },
  setup(){
    const divs = ref([])

	 /**resets value before update */
    onBeforeUpdate(() => {
        divs.value = []
      })

	  /**
		* when card is rejected,
		* @function stackReject is called from parent component
		* and calls child @function cardReject through refs
	   */
	  function stackReject(){
      divs.value[0].cardReject()
	  }

	   /**
		* when card is accepted,
		* @function stackAccept is called from parent component
		* and calls child @function cardAccept through refs
	   */
	   function stackAccept(){
      divs.value[0].cardAccept()
	  }

    return {
      stackReject,
      stackAccept,
      divs
    }
  },
};
</script>
