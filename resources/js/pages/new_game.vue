<template>
  <div class="form__row">
    <div class="form__field">
      <input
        type="search"
        placeholder="Recherche un ami…"
        v-model="searchText"
      />
      <i class="icon-search"></i>
    </div>
  </div>

  <div class="searchFriends__container">
    <ul class="searchFriends">
      <div>
        <li v-for="data in filteredList()" :key="data">
          <input
            @click="playerSelected()"
            type="radio"
            :id="`${data}`"
            name="user"
            :value="`${data}`"
          />
          <label :for="`${data}`">
            <div class="searchFriends__avatar">
              <avatar :data="this.findId(data)"></avatar>
            </div>

            {{ data }}
          </label>
        </li>
      </div>
    </ul>
  </div>

  <div
    class="searchFriends--noFriend"
    v-if="showRandomPlayer()"
    :key="searchText"
  >
    <div class="searchFriends__title">Tu n'as pas d'ami ?</div>

    <div class="btn btn--secondary" @click="this.randomPlayer()">
      Victime aléatoire
    </div>
  </div>

  <div class="bottombar">
    <input
      v-if="this.returnValue"
      class="btn btn--primary"
      id="submit--new--game"
      type="submit"
      value="Suivant"
    />
  </div>
</template>

<script>
import { ref } from "vue";
import avatar from "../elements/show_avatar.vue";

export default {
  /**
   * Props
   * @param {Object} datas Datas to order
   */
  props: {
    datas: Object,
  },

  components: {
    avatar,
  },

  data() {
    return {
      randomPlayerPseudo: "",
      returnValue: false,
      randomActualise: false,
    };
  },

  setup(props) {
    let searchText = ref("");
    let list = [];

    /**
     * Show or hide the button for a random player depending on the input text value
     *
     * @return {Boolean} Returns true if the value of the searchText is empty, false else
     */
    function showRandomPlayer() {
      if (searchText.value == "") return true;
      else {
        return false;
      }
    }

    /**
     * Filter the list of User with the input box and returns an array of corresponding users
     *
     * @return {Array} Returns an Array empty if searchValue is empty, or the filteredListed
     */
    function filteredList() {
      list = [];
      let datas = props.datas;
      if (searchText.value == "") {
        return list;
      }

      this.playerSelected;

      for (let index in datas) {
        list.push(datas[index].pseudo);
      }

      return list.filter((data) =>
        data.toLowerCase().includes(searchText.value.toLowerCase())
      );
    }

    /**
     * @returns {Object} Returns all the variables needed in the template
     */
    return { 
      searchText, 
      filteredList, 
      showRandomPlayer 
      };
  },

  methods: {
    
    /**
     * Return a random player from the available ones, show it in the input text and selects it
     * @returns {String} Returns a random pseudo that can be played against
     */
    randomPlayer() {
      this.playerSelected;
      var keys = Object.keys(this.$props.datas);
      this.randomPlayerPseudo =
        this.$props.datas[keys[(keys.length * Math.random()) << 0]].pseudo;
      this.searchText = this.randomPlayerPseudo;
      this.randomActualise = true;
      return this.randomPlayerPseudo;
    },

    /**
     * Return a true value if a player is selected
     * 
     */
    playerSelected() {
      this.returnValue = false;
      document.querySelectorAll("li").forEach((element) => {
        if (element.querySelector("input").checked) {
          this.returnValue = true;
        }
      });
    },

    /**
     * Find the ID of a given pseudo
     * @param {string} pseudo Pseudo to find
     * 
     * @returns ID of given Pseudo
     * 
     */
    findId(pseudo) {
      if (typeof pseudo == "string") {
        return this.$props.datas.find((e) => e.pseudo == pseudo).id;
      }
    },
  },
  updated() {
    this.findId(this.$props.datas);
    
    //after datas and DOM are updated
    this.$nextTick(function () {
      //Hide the submit button if searchText is empty
      if (this.searchText == "") {
        this.returnValue = false;
        this.randomPlayerPseudo = "";
      }

      //Checks the randomPlayer input radio
      if (this.randomPlayerPseudo != "" && this.randomActualise) {
        document.getElementById(this.randomPlayerPseudo).checked = true;
        this.randomActualise = false;
        this.returnValue = true;
      }
    });
  },
};
</script>
