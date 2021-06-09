<template>
  <input type="text" v-model="searchText" />
  <ul>
    <li v-for="data in filteredList()" :key="data">
      <input type="radio" :id="`${data}`" name="user" :value="`${data}`" />
      <label :for="`${data}`">{{ data }}</label>
    </li>
  </ul>
  <div></div>
</template>

<script>
import { ref } from "vue";

export default {
  components: {},

  data() {
    return {};
  },

  props: {
    datas: Object,
  },

  setup(props) {
    let searchText = ref("");
    console.log(searchText);
    let list = [];

    function filteredList() {
      list = [];
      let datas = props.datas;

      for(let index in datas){
        list.push(datas[index].pseudo)
      }

      return list.filter(data => data.toLowerCase().includes(searchText.value.toLowerCase()))
    }

    return { searchText, filteredList };
  },

  mounted: function () {},

  methods: {},
};
</script>

