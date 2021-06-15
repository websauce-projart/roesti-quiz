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
import { useKeypress } from "vue3-keypress";

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
