<template>
  <div
    v-if="isShowing"
    ref="interactElement"
    :class="{
      isAnimating: isInteractAnimating,
      isCurrent: isCurrent,
    }"
    class="card"
    :style="{ transform: transformString,
	 			  }"

  	>
    <h3 class="cardTitle">{{ card }}</h3>


</div>
</template>

<script>
import interact from "interactjs";

const ACCEPT_CARD = "cardAccepted";
const REJECT_CARD = "cardRejected";


export default {
  static: {
    interactMaxRotation: 15,
    interactOutOfSightXCoordinate: 180,
    interactXThreshold: 100,
  },

  props: {
	  /**
		* contains the card question
	   */
    card: {
      type: String,
      required: true,
    },

	 /**
	  * Give a distinctive look to the card when needed
	  */
    isCurrent: {
      type: Boolean,
      required: true,
    },

	 /**
	  * Question ID needed to select and check the related
	  * checkbox
	  */
	 qid:{
		 type: Number,
		 required: true,
	 },

  },

  data() {;
    return {
      isShowing: true,
      isInteractAnimating: true,
      isInteractDragged: null,
		/**
		 * values that indicate a card’s order in the stack
		 * when it’s moved from its original position
		 */
      interactPosition: {
        x: 0,
        y: 0,
        rotation: 0,
      },
    };
  },

  computed: {
	  /**
		* Creates a transform value and applies it to our element
	   */
    transformString() {
      if (!this.isInteractAnimating || this.isInteractDragged) {
        const { x, y, rotation } = this.interactPosition;
        return `translate3D(${x}px, ${y}px, 0) rotate(${rotation}deg)`;
      }

      return null;
    },
  },

  mounted() {
    const element = this.$refs.interactElement;

	 /**
	  * @method onstart : deactivates the transition as soon as
	  * the card is dragged to cut the animation lag
	  *
	  * @method onmove : fires a custom function each
	  * time the element is dragged.
	  * ** @argument event carries information about
	  * 	 how far the card is dragged. We then calculates
	  *    the new position and sets it in the @function transformString
	  *
	  * @method onend : listens when user stops interacting
	  * 	checks if card was thrown beyond thresholds or not
	  *	* if met, accepts or rejects cards depending on the side
	  *	* if not, resets card position
	  *
	  */
    interact(element).draggable({
      onstart: () => {
        this.isInteractAnimating = false;
      },

      onmove: (event) => {
        const { interactMaxRotation, interactXThreshold } =
          this.$options.static;
        const x = this.interactPosition.x + event.dx;
        const y = this.interactPosition.y + event.dy;

        let rotation = interactMaxRotation * (x / interactXThreshold);

        if (rotation > interactMaxRotation) rotation = interactMaxRotation;
        else if (rotation < -interactMaxRotation)
          rotation = -interactMaxRotation;

        this.interactSetPosition({ x, y, rotation });
      },

      onend: () => {
        const { x } = this.interactPosition;
        const { interactXThreshold } = this.$options.static;
        this.isInteractAnimating = true;

        if (x > interactXThreshold && this.$props.isCurrent) this.playCard(ACCEPT_CARD);
        else if (x < -interactXThreshold && this.$props.isCurrent) this.playCard(REJECT_CARD);
        else this.resetCardPosition();
      },

    });

  },
	/**
	 * removes all event listeners and
	 * makes interact.js completely forget about the target
	 */
  beforeUnmount() {
    interact(this.$refs.interactElement).unset();

  },

  methods: {
	 /**
	  * hides the card we played and adds a timeout
	  * to let it animate out of sight
	  */
    hideCard() {
      setTimeout(() => {
        this.isShowing = false;
        this.$emit("hideCard", this.card)

      }, 150);
    },

	 /**
	  * if treshhold met, handles the acceptation
	  * or rejection of the card
	  */
    playCard(interaction) {
      const {
        interactOutOfSightXCoordinate,
        interactMaxRotation,
      } = this.$options.static;

      this.interactUnsetElement();

      switch (interaction) {
        case ACCEPT_CARD:
          this.interactSetPosition({
            x: interactOutOfSightXCoordinate,
            rotation: interactMaxRotation,
          });
          this.$emit(ACCEPT_CARD);
          break;
        case REJECT_CARD:
          this.interactSetPosition({
            x: -interactOutOfSightXCoordinate,
            rotation: -interactMaxRotation,
          });
          this.$emit(REJECT_CARD);
          break;
      }

      this.hideCard();
    },

	/**
	 * calculates  cards position
	 */
    interactSetPosition(coordinates) {
      const { x = 0, y = 0, rotation = 0 } = coordinates;
      this.interactPosition = { x, y, rotation };
    },

	/**
	 * unsets element
	 */
    interactUnsetElement() {
      interact(this.$refs.interactElement).unset();
      this.isInteractDragged = true;
    },

	 /**
	  * resets card position
	  */
    resetCardPosition() {
      this.interactSetPosition({ x: 0, y: 0, rotation: 0 });
    },

	 /**
		* when card is accepted,
		* @function cardAccept is called from parent component
		* and calls @function playCard with @param ACCEPT_CARD
	   */
	 cardAccept(){
		 this.playCard(ACCEPT_CARD)

	 },

	 /**
		* when card is accepted,
		* @function cardReject is called from parent component
		* and calls @function playCard with @param REJECT_CARD
	   */
	 cardReject(){
		 this.playCard(REJECT_CARD);
	 },
  },
};
</script>
