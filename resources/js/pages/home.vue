<template>
  <navbar></navbar>
  <div class="container--game">
    <div v-if="datas.length == 0">
      Tu n'as encore aucune partie en cours. Clique sur nouvelle partie pour un
      max de fun !
    </div>

    <h1 class="home--game--h1" v-if="datas.length == 1">Partie en cours</h1>
    <h1 class="home--game--h1" v-else>Parties en cours</h1>

    <div v-for="data in datasOrderd" :key="data">
      <game-home :data="data"></game-home>
    </div>
  </div>
</template>

<script>
import navbar from "../elements/nav.vue";
import gameHome from "../components/gameHome.vue";

export default {
  components: { navbar, gameHome },

  data() {
    return {
      datas: {},
      datasOrderd: [],
    };
  },

  props: {
    data_url: String,
  },

  setup(props) {},

  mounted: function () {
    this.orderData();
  },

  created() {
    this.interval = setInterval(() => this.orderData(), 5000);
  },

  methods: {
    async orderData() {
      await this.fetchText();
      this.datasOrderd = [];
      for (var index in this.datas) {
        if (
          this.datas[index].user.id == this.datas[index].game.active_user_id
        ) {
          this.datasOrderd.unshift(this.datas[index]);
        } else {
          this.datasOrderd.push(this.datas[index]);
        }
      }
    },
    fetchText() {
      this.datas = {};
      return axios
        .get(this.$props.data_url)
        .then((response) => (this.datas = response.data))
        .catch((errors) => console.log(errors));
    },
  },
};
</script>

