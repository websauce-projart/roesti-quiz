<template>
  <div class="game__btn__container">

      <button type="button" id="rejecter" class="game__btn reject" @click="buttonRejected">
        ✘
      </button>
      <button type="button" id="accepter" class="game__btn accept" @click="buttonAccepted">
        ✔
      </button>
  </div>
</template>

<script>
let emitter = require('tiny-emitter/instance');
export default {
  name: "GameButtons",

  methods: {
    buttonRejected() {
      console.log("REJETE");
		emitter.emit("buttonRejected");
    },
    buttonAccepted() {
      console.log("ACCEPTE");
    },
  },
};
</script>
