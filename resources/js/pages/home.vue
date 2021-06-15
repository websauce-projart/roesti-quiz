<template>
  <div class="gameBadge__container" v-if="datas.length == 0">
    <div class="gameBadge__noGame">
      <p>Tu n'as encore aucune partie en cours.</p>
      <p>Pour un max de fun, clique sur <mark>nouvelle partie</mark></p>
    </div>
  </div>
  <div class="gameBadge__container" v-else>
    <div>
      <h1 class="gameBadge__title" v-if="datas.length > 1">Parties en cours</h1>
      <h1 class="gameBadge__title" v-else>Partie en cours</h1>

      <div class="gameBadge--wrapper" v-for="data in datasOrderd" :key="data">
        <game-home :data="data"></game-home>
      </div>

      <div class="gameBadge--phantom"></div>
    </div>
  </div>
</template>

<script>
import gameHome from "../components/gameHome.vue";

export default {
  components: { gameHome },

  data() {
    return {
      datas: {},
      datasOrderd: [],
      changedData: true,
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
    if (this.changedData)
      this.interval = setInterval(() => this.orderData(), 5000);
  },

  methods: {
    async orderData() {
      await this.fetchText();

      let newData = [];
      for (var index in this.datas) {
        if (
          this.datas[index].user.id == this.datas[index].game.active_user_id
        ) {
          newData.unshift(this.datas[index]);
        } else {
          newData.push(this.datas[index]);
        }
      }
      if (JSON.stringify(this.datasOrderd) != JSON.stringify(newData))
        this.datasOrderd = newData;
    },

    fetchText() {
      return axios
        .get(this.$props.data_url)
        .then((response) => {
          if (this.datas.length == response.data.length)
            this.changedData == false;
          this.datas = response.data;
        })
        .catch((errors) => console.log(errors));
    },
  },
};
</script>
