<template>
  <div
    class="home--game"
    :class="data.game.active_user_id !== data.user.id && 'home--game--wait'"
  >
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
    return {};
  },
  props: {
    data: Object,
  },
};
</script>

<style>
</style>