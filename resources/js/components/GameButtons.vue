<template>

  <div class="game__btn__container">

      <button type="button" class="game__btn reject" @click="buttonRejected">
        ✘
      </button>
      <button type="button" class="game__btn accept" @click="buttonAccepted">
        ✔
      </button>
  </div>
</template>

<script>
export default {
  name: "GameButtons",

	// props:{
	// 	qid:{
	// 	 type: Number,
	// 	 required: true,
	//  }
	// },

  methods: {
    buttonRejected() {
      console.log("REJETE");
		this.$emit('reject');
    },
    buttonAccepted() {
      console.log("ACCEPTE");
		this.$emit('accept');
    },
  },
};
</script>
