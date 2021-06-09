<template>
  <input type="text" v-model="searchText" />
  <ul>
    <li v-for="data in filteredList()" :key="data">
      <input type="radio" :id="`${data}`" name="user" :value="`${data}`" />
      <label :for="`${data}`">{{ data }}</label>
    </li>
  </ul>
  <div class="test--random--par" v-if="showRandomPlayer()" :key="searchText">
    <div class="test--text test--random">Tu n'as pas d'ami ?</div>

    <div class="btn btn--secondary" @click="randomPlayer()">Victime aléatoire</div>
  </div>
</template>

<script>
import { ref } from "vue";

export default {
  props: {
    datas: Object,
  },

  setup(props) {
    let searchText = ref("");

    let list = [];

    function showRandomPlayer() {
      if (searchText.value == "") return true;
      else {
        return false;
      }
    }

    function randomPlayer(){
      var keys = Object.keys(props.datas);
      return props.datas[keys[ keys.length * Math.random() << 0]].pseudo;
    }

    function filteredList() {
      list = [];
      let datas = props.datas;

      if (searchText.value == "") {
        return list;
      }

      for (let index in datas) {
        list.push(datas[index].pseudo);
      }

      return list.filter((data) =>
        data.toLowerCase().includes(searchText.value.toLowerCase())
      );
    }

    return { searchText, filteredList, showRandomPlayer, randomPlayer };
  },
};
</script>

