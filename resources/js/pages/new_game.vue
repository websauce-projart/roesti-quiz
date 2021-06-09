<template>
  <input type="text" v-model="searchText">
  <ul v-if="filteredList().length == 5">
    <li v-for="data in filteredList()" :key="data">
      {{ data }}
    </li>
  </ul>
</template>

// <div>
//                 <input type="radio" id="{{ $opponent->id }}" name="user" value="{{ $opponent->id }}">
//                 <label for="{{ $opponent->id }}">{{ $opponent->pseudo }}</label>
//             </div>

<script>
import { ref } from "vue";

export default {
  components: {},

  data() {
    return {
      datasOrderd: [],
    };
  },

  props: {
    datas: Object,
  },

  setup(props) {
    let searchText = ref('');
    const list = [
      'orange',
      'red',
      'blue',
      'black',
      'white'
    ]
    
    function filteredList() {
      return list.filter(data => data.toLowerCase().includes(searchText.value.toLowerCase()))
    }
    
    return {searchText, filteredList}
  },

  mounted: function () {
    
  },

  methods: {

  },
};
</script>

