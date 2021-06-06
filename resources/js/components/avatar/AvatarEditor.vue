<script>
import ElementScroller from './ElementScroller.vue';

export default {
    components: {ElementScroller},
    setup() {

        // document.getElementById('eye').style.backgroundImage="url(/storage/img/yeux.png)"
    }
}
</script>

<template>
    <div id="avatar__container">
        <element-scroller 
        label="eye"
        v-bind:url="/storage/img/yeux.png"
        ></element-scroller>
        <element-scroller 
        label="mouth"
        v-bind:url="/storage/img/bouches.png"
        ></element-scroller>
        <element-scroller label="pose"></element-scroller>
    </div>
</template>

<style scoped>
    #avatar__container {
        border: 1px solid black;
        position: relative;
        width: 94px;
        height: 94px;
    }
</style>