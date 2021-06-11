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
  name: "game-buttons",

  methods: {
    buttonRejected() {
      console.log("REJETE");
    },
    buttonAccepted() {
      console.log("ACCEPTE");
    },
  },
};
</script>
