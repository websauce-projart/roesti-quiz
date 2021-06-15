<template>
  <div class="avatar__container">
    <img
      src="img/avatar/assets_avatar_background.svg"
      class="avatar__element"
    />

    <img v-if="loaded" :src="pose" class="avatar__element" />
    <img v-if="loaded" :src="eye" class="avatar__element" />
    <img v-if="loaded" :src="mouth" class="avatar__element" />
  </div>
</template>

<script>
import { ref } from "vue";

export default {

  /**
   * Props
   * @param {Boolean} loaded Needs to be trigerred 
   * @param {Number} data Id of the user
   */
  props: {
    loaded: Boolean,
    data: Number
  },
  setup(props) {
    //Declaration of the different variables, using ref() if reactive needed
    let dataAvatar = ref([]);
    let loaded = ref(props.loaded);
    const urlImg = "img/avatar/";
    const urlApi = "api/avatar/";
    let pose = ref();
    let mouth = ref();
    let eye = ref();

    /**
     * Get the datas from the API with the ID
     *
     * @param {number} idUser ID of the user that we want to get the datas from
     */
    async function getData(idUser) {
      await fetch(urlApi + idUser)
        .then((response) => response.json())
        .then((e) => (dataAvatar.value = e))
        .then((e) => {
          concactUrl(dataAvatar.value);
          loaded.value = true;
        });
    }
    /**
     * Sets the values of each parts of the avatar
     *
     * @param {Object} data Object containing the parts of his avatar and his pseudo
     */
    function concactUrl(data) {
      pose.value = urlImg + "poses/assets_avatar_pose" + data.pose + ".svg";
      eye.value = urlImg + "eyes/assets_avatar_yeux" + data.eye + ".svg";
      mouth.value =
        urlImg + "mouths/assets_avatar_bouche" + data.mouth + ".svg";
    }

    //Calls the Data and input them
    getData(props.data)


    /**
     * @returns {Object} Returns all the variables needed in the template
     */
    return {
      loaded,
      pose,
      mouth,
      eye,
    };
  },
};
</script>