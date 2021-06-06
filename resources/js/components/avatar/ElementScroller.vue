<script>
import { ref, computed, watchEffect, watch } from "vue";

export default {
    props: {
        label: {type: String},
        url: {type: String}
    },
    setup(props, context) {
        const offset = 0;
        const value = "";
    }


}
</script>

<template>
    <div class="element" style="background-image: url('{{url}}')">
        {{label}}
    </div>
</template>

<style scoped>
    .element {
        width: 100%;
        height: 100%;
        position: absolute;
        background-repeat: no-repeat;
    }

</style>
