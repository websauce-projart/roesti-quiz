<template>
  <div class="game__btn__container">
	  <div class="game__btn__wrapper">
		<button type="button" class="game__btn reject icon-close" aria-label="Faux" @click="buttonRejected"></button>
		<button type="button" class="game__btn accept icon-checkmark" aria-label="Vrai" @click="buttonAccepted"></button>
	 </div>
  </div>
</template>

<script>
import { useKeypress } from "vue3-keypress";
import { ref } from "vue";
export default {
  name: "GameButtons",

  setup(_, { emit }) {
    const someSuccessCallback = ({ keyCode }) => {
      if (keyCode === 37) {
        emit("reject");
      } else if (keyCode === 39) {
        emit("accept");
      }
    };

    useKeypress({
      keyEvent: "keydown",
      keyBinds: [
        {
          keyCode: "left", // or keyCode as integer, e.g. 37
          success: someSuccessCallback,
          preventDefault: true, // the default is true
        },
        {
          keyCode: "right", // or keyCode as integer, e.g. 39
          success: someSuccessCallback,
          preventDefault: true, // the default is true
        },
      ],
    });
  },

  methods: {
    buttonRejected() {
      this.$emit("reject");
    },
    buttonAccepted() {
      this.$emit("accept");
    },
  },
};
</script>
