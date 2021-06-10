<template>
  <div
    class="home--game"
    :class="data.game.active_user_id !== data.user.id && 'home--game--wait'"
  >
    <div class="avatar__container">
      <img
        src="/img/avatar/assets_avatar_background.svg"
        class="avatar__element"
      />
      <img v-if="loaded" :src="this.pose" class="avatar__element" />
      <img v-if="loaded" :src="this.eye" class="avatar__element" />
      <img v-if="loaded" :src="this.mouth" class="avatar__element" />
    </div>
    <span class="home--game--pseudo">{{ data.opponent.pseudo }}</span>
    <span
      class="home--game--info"
      v-if="data.game.active_user_id == data.user.id"
      >À toi de jouer</span
    >
    <span class="home--game--info" v-else
      >N'a pas encore relevé ton défi...</span
    >
    <span
      class="home--game--play"
      v-if="data.game.active_user_id == data.user.id"
    >
      <span class="home--game--play--text">-></span>
    </span>
    <a class="home--game--submit" :href="'game/' + data.game.id"></a>
  </div>
</template>

<script>
export default {
  data() {
    return {
      avatarData: Object,
      urlApi: "/api/avatar/",
      urlImg: "/img/avatar/",
      pose: String,
      eye: String,
      mouth: String,
      loaded: false,
    };
  },
  props: {
    data: Object,
  },
  mounted: async function () {
    await this.fetchData();
    this.concatUrl();
    this.loaded = true;
  },

  methods: {
    fetchData() {
      let user = this.$props.data.opponent.id;
      return axios
        .get(this.urlApi + user)
        .then((response) => {
          this.avatarData = response.data;
        })
        .catch((errors) => console.log(errors));
    },
    concatUrl(){
      this.pose = this.urlImg + 'poses/assets_avatar_pose' + this.avatarData.pose + '.svg';
      this.eye = this.urlImg + 'eyes/assets_avatar_yeux' + this.avatarData.eye + '.svg';
      this.mouth = this.urlImg + 'mouths/assets_avatar_bouche' + this.avatarData.mouth + '.svg';
    }
  },
};
</script>

<style>
</style>