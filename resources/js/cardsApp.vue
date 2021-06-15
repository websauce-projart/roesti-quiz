<template>
  <div id="cardscontainer">
    <GameCardsStack
      :cards="visibleCards"
      :qid="qid"
      @hideCard="removeCardFromDeck"
      @reject="SwipeLeft"
      @accept="SwipeRight"
      ref="gameCardStack"
    />
  </div>
</template>

<script>
import GameCardsStack from "./components/GameCardsStack";
import GameCard from "./components/GameCard.vue";

export default {
  name: "CardsApp",
  components: {
    GameCardsStack,
  },

  data() {
    return {
      visibleCards: [],
      qid: Array,
    };
  },

  props: {
    datas: Object,
  },

  methods: {
    handleCardAccepted() {
      document.getElementById(this.qid[0]).checked = true;
    },
    removeCardFromDeck() {
      this.visibleCards.shift();
      this.qid.shift();
      let test = [];
      if (this.qid.length === test.length) {
        document.getElementById("quizForm").submit();
      }
    },

    createQuestionsArray() {
      let datas = this.$props.datas;
      let labels = [];
      let ids = [];

      for (let index in datas) {
        labels.push(datas[index].label);
        ids.push(datas[index].id);
      }

      this.visibleCards = labels;
      this.qid = ids;
    },

    SwipeLeft() {
      this.$refs.gameCardStack.testReject();
    },

    SwipeRight() {
      this.$refs.gameCardStack.testAccept();
    },
  },

  created() {
    this.createQuestionsArray();
  },

  mounted() {},
};
</script>

<style>
#cardscontainer {
  text-align: center;
}

.cards-container {
  display: block;
  width: 30rem;
  margin: auto;
  margin-top: var(--margin-l);
}

.card {
  box-shadow: var(--boxshadow-card);
  transition: 0.3s;
  border-radius: 5px; /* 5px rounded corners */
  background: var(--color-white);
  border-radius: var(--borderradius-m);
  padding: var(--margin-m);
  display: flex;
  height: 20rem;
  width: 30rem;
  justify-content: center;
  align-items: center;
  position: absolute;
  margin-top: 3rem;
  pointer-events: none;
}

@media (max-width: 768px) {
  .cards {
    display: flex;
    justify-content: center;
  }
  .card {
    padding: var(--margin-m);
    width: 17rem;
    height: 22rem;
  }
  .card .cardTitle {
    font-size: var(--fontsize-l);
  }
}

.cardTitle {
  font-family: var(--font-text);
  font-size: var(--fontsize-ll);
  font-weight: 300;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

.card,
.card * {
  -ms-touch-action: none;
  touch-action: none;
}

.isCurrent {
  margin-top: 1rem;
}

.a0 {
  z-index: 10;
  pointer-events: auto;
}

.a1 {
  z-index: 9;
  margin-top: 2rem;
}

.a2 {
  z-index: 8;
}

.a3 {
  z-index: 7;
}

.a4 {
  z-index: 6;
}

.a5 {
  z-index: 5;
}

.a6 {
  z-index: 4;
}

.a7 {
  z-index: 3;
}

.a8 {
  z-index: 2;
}

.a9 {
  z-index: 1;
}
</style>
