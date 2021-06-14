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
	 :id="id"
  	>
    <h3 class="cardTitle">{{ card }}
	 </h3>


</div>
</template>

<script>
import interact from "interactjs";
import GameButtons from "./GameButtons.vue";

const ACCEPT_CARD = "cardAccepted";
const REJECT_CARD = "cardRejected";


export default {
// 	 components: {
// 	 GameButtons
//   },

  static: {
    interactMaxRotation: 15,
    interactOutOfSightXCoordinate: 180,
    interactOutOfSightYCoordinate: 600,
    interactYThreshold: 150,
    interactXThreshold: 100,
  },

  props: {
    card: {
      type: String,
      required: true,
    },
    isCurrent: {
      type: Boolean,
      required: true,
    },
	 qid:{
		 type: Number,
		 required: true,
	 },

	 id:{
		 type: Number,
		 required: true,
	 }
  },

  data() {;
    return {
      isShowing: true,
      isInteractAnimating: true,
      isInteractDragged: null,
      interactPosition: {
        x: 0,
        y: 0,
        rotation: 0,
      },
    };
  },

  computed: {
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

	//  console.log(this.id);

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
        const { x, y } = this.interactPosition;
        const { interactXThreshold, interactYThreshold } = this.$options.static;
        this.isInteractAnimating = true;

        if (x > interactXThreshold && this.$props.isCurrent) this.playCard(ACCEPT_CARD);
        else if (x < -interactXThreshold && this.$props.isCurrent) this.playCard(REJECT_CARD);
        else this.resetCardPosition();
      },

    });

  },

  beforeUnmount() {

    interact(this.$refs.interactElement).unset();

  },

  beforeUpdate(){
      // this.$nextTick(function () {
      //   console.log(document.getElementsByClassName("isCurrent")[0]);
		//  console.log(" ↑");
		//  console.log("↓");
		//  console.log(this.$refs.interactElement);
      // });
  },

  methods: {
    hideCard() {
      setTimeout(() => {
        this.isShowing = false;
        this.$emit("hideCard", this.card)

      }, 150);
    },

    playCard(interaction) {
      const {
        interactOutOfSightXCoordinate,
        interactOutOfSightYCoordinate,
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

    interactSetPosition(coordinates) {
      const { x = 0, y = 0, rotation = 0 } = coordinates;
      this.interactPosition = { x, y, rotation };
    },

    interactUnsetElement() {
      interact(this.$refs.interactElement).unset();
      this.isInteractDragged = true;
    },

    resetCardPosition() {
      this.interactSetPosition({ x: 0, y: 0, rotation: 0 });
    },

	 testAccept(){
		 console.log(document.getElementsByClassName("isCurrent")[0]);
		 console.log("la carte voulue ↑");
		 console.log("la carte avec laquelle on interagit ↓");
		 console.log(this.$refs.interactElement);
		 this.playCard(ACCEPT_CARD)

	 },

	 testReject(){
		 console.log(document.getElementsByClassName("isCurrent")[0]);
		 console.log("la carte voulue ↑");
		 console.log("la carte avec laquelle on interagit ↓");
		 console.log(this.$refs.interactElement);
		 this.playCard(REJECT_CARD);
	 },
  },
};
</script>

<style>

.isCurrent{
	color:blue;
	margin-top: 1rem;

}
</style>
