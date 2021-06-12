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
  props: {
    dataHome: Object,
    loaded: Boolean,
    dataSearch: Number,
  },
  setup(props) {
    let dataAvatar = ref([]);
    let loaded = ref(props.loaded);
    const urlImg = "img/avatar/";
    let pose = ref();
    let mouth = ref();
    let eye = ref();

    if (props.dataHome !== undefined) {
      function concatUrlHome(data) {
        pose.value = urlImg + "poses/assets_avatar_pose" + data.pose + ".svg";
        eye.value = urlImg + "eyes/assets_avatar_yeux" + data.eye + ".svg";
        mouth.value =
          urlImg + "mouths/assets_avatar_bouche" + data.mouth + ".svg";
      }

      concatUrlHome(props.dataHome);
    }

    if (props.dataSearch !== undefined) {
      function concactUrlSearch(data) {
        pose.value = urlImg + "poses/assets_avatar_pose" + data.pose + ".svg";
        eye.value = urlImg + "eyes/assets_avatar_yeux" + data.eye + ".svg";
        mouth.value =
          urlImg + "mouths/assets_avatar_bouche" + data.mouth + ".svg";
      }

      async function getData() {
        await fetch("api/avatar/" + props.dataSearch)
          .then((response) => response.json())
          .then((e) => (dataAvatar.value = e))
          .then(() => {
              concactUrlSearch(dataAvatar.value);
              loaded.value = true;
          });
      }
      getData();
    }

    return {
      dataAvatar,
      loaded,
      pose,
      mouth,
      eye,
    };
  },
};
</script>