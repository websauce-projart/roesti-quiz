<template>
  <navbar></navbar>

  <div class="container--game">
    <div v-if="datas.length == 0">
      Tu n'as encore aucune partie en cours. Clique sur nouvelle partie pour un
      max de fun !
    </div>

    <h1 class="home--game--h1" v-if="datas.length == 1">Partie en cours</h1>
    <h1 class="home--game--h1" v-else>Parties en cours</h1>

    <div v-for="data in datas" :key="data">
      <div class="home--game" v-if="data.game.active_user_id == data.user.id">
        <span class="home--game--pseudo">{{ data.opponent.pseudo }}</span>
        <span class="home--game--info">À toi de jouer</span>
        <span class="home--game--play">
          <span class="home--game--play--text">-></span>
        </span>
        <a class="home--game--submit" :href="'game/' + data.game.id"></a>
      </div>
    </div>
     <div v-for="data in datas" :key="data">
      <div class="home--game home--game--wait" v-if="data.game.active_user_id !== data.user.id">
        <span class="home--game--pseudo">{{ data.opponent.pseudo }}</span>
        <span class="home--game--info">N'a pas encore relevé ton défi...</span>
        <span class="home--game--play">
          <span class="home--game--play--text">-></span>
        </span>
        <a class="home--game--submit" :href="'game/' + data.game.id"></a>
      </div>
    </div>
  </div>
</template>

<script>
import navbar from "./elements/nav.vue";

export default {
  components: { navbar },

  props: {
    datas: Object,
  },

  setup(props) {

  },

  mounted: function () {
      this.refresh()
  },

  methods: {
    refresh() {
      this.$nextTick(function () {
        console.log('yo')
      });
    },
  },
};
</script>

