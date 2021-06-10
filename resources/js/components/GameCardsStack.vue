<template>
   <div class="cards">
    <GameCard
      v-for="(card, index) in cards"
      :key="card"
      :card="card"
      :is-current="index === 0"
		:class="'a'+index"

      @cardAccepted="$emit('cardAccepted');"
      @cardRejected="$emit('cardRejected');"
      @cardSkipped="$emit('cardSkipped');"
      @hideCard="$emit('hideCard');"
		>
		</GameCard>
  </div>
</template>
<script>
   import GameCard from "./GameCard"

   export default {
     components: {
       GameCard
     },
     props: {
       cards: {
         type: Array,
         required: true
       },
     }
   }

</script>

<style>

.a0{
	z-index: +10;
}

.a1{
	z-index: +9;
}

.a2{
	z-index: +8;
}

.a3{
	z-index: +7;
}

.a4{
	z-index: +6;
}

.a5{
	z-index: +5;
}

.a6{
	z-index: +4;
}

.a7{
	z-index: +3;
}

.a8{
	z-index: +2;
}

.a9{
	z-index: +2;
}



.cards{
	color: red;

}



</style>
