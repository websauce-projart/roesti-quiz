<template>
  <div class="gameBadge__container" v-if="datasLength == 0">
    <div class="gameBadge__noGame">
      <p>Tu n'as encore aucune partie en cours...</p>
      <p>Pour un max de fun, clique sur <mark>nouvelle partie</mark> !</p>
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
import { ref } from "vue";

export default {
  components: { gameHome },

  /**
   * Props
   * @param {String} data_url URL to get the datas from
   */
  props: {
    data_url: String,
  },

  setup(props) {
    let datas = ref({});
    let datasOrderd = ref([]);
    let datasLength = ref(0);
    let newData = [];
  
    /**
     * Wait the datas and put them in an array.
     * If the newArray is different from the current datasOrdered, update the value of datasOrdered
     * 
     */
    async function orderData() {
      await fetchText();
      
      newData = [];

      for (var index in datas) {
        if (datas[index].user.id == datas[index].game.active_user_id) {
          newData.unshift(datas[index]);
        } else {
          newData.push(datas[index]);
        }
      }

      datasLength.value = datas.length

      if (JSON.stringify(datasOrderd.value) != JSON.stringify(newData))
        datasOrderd.value = newData;
    }

    /**
     * Returns an axios that gets the datas from the URL API
     * Then update datas with the response datas.
     * 
     * @return Response or errors
     */

    function fetchText() {
      return axios
        .get(props.data_url)
        .then((response) => {
          datas = response.data;

        })
        .catch((errors) => console.log(errors));
    }

    orderData();


    //Each 5 seconds, gets the data to watch for a change
    setInterval(function () {
      orderData();
    }, 5000);

    
     /**
     * @returns {Object} Returns all the variables needed in the template
     */
    
    return {
      datas,
      datasOrderd,
      datasLength
    };
  },
};
</script>
