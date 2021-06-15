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

export default {
  name: "GameButtons",

  setup(_, { emit }) {
	  /**
		* Checks keycode of pressed key & fires one of two events
		*
		* @emits reject - fires a custom event to the parent
	   * component when the left arrow key (←) is pressed
		*
		* @emits accept - fires a custom event to the parent
	   * component when the right arrow key (→) is pressed
	   */
    const someSuccessCallback = ({ keyCode }) => {
      if (keyCode === 37) {
        emit("reject");
      } else if (keyCode === 39) {
        emit("accept");
      }
    };
	 /**
	  * Reacts on when a key event.
	  *
	  * @method keyEvent : "keydown" precises the event
	  * @method keyBinds : specifies which keys are listened to
	  * 						  & what to do when the event is triggered
	  *
	  */
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

  /**
	* following methods are called from parent via ref
   */
  methods: {
	/**
	 *
	 * @emits reject - fires a custom event to the parent
	 * component when the reject button is clicked
	 *
	 */
    buttonRejected() {
      this.$emit("reject");
    },

	 /**
	 * @emits accept - fires a custom event to the parent
	 * component when the accept button is clicked
	 *
	 *
	 */
    buttonAccepted() {
      this.$emit("accept");
    },
  },
};
</script>
