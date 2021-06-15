<template>
  <a
    class="gameBadge"
    :href="'game/' + data.game.id + '/join'"
    :class="data.game.active_user_id !== data.user.id && 'gameBadge--wait'"
  >
    
    <div class="gameBadge__avatar">
		<avatar :data="dataHome" :loaded="loaded"></avatar>
	</div>
    <div class="gameBadge__info">
      <div class="gameBadge__info__pseudo">{{ data.opponent.pseudo }}</div>
      <div
        class="gameBadge__info__statut"
        v-if="data.game.active_user_id == data.user.id"
      >
        À toi de jouer
      </div>
      <div class="gameBadge__info__statut" v-else>
        N'a pas encore relevé ton défi...
      </div>
    </div>

    <div
      class="gameBadge__play icon-arrow-right"
      v-if="data.game.active_user_id == data.user.id"
    ></div>
  </a>
</template>

<script>
import avatar from "../elements/show_avatar.vue";
import { ref } from 'vue';

export default {
  components: {
    avatar,
  },
  /**
   * Props
   * @param {Object} data Datas to give
   */
  props: {
    data: Object,
  },
  setup(props){
	let dataHome = ref(props.data.opponent.id)
	let loaded = false

	return {
		dataHome,
		loaded
	}
  }
};
</script>