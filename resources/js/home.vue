<template>
<navbar></navbar>
</template>

<script>
    import navbar from './elements/nav.vue';
	import inputText from './components/inputText.vue';
	import gameHome from './components/gameHome.vue';
	import GameCard from './components/GameCard.vue';
	import GameCardsStack from './components/GameCardsStack.vue';

    export default {
        components: {navbar, inputText, gameHome, GameCardsStack},
        props:[
            'classes',
            ],
        setup(props) {
            console.log(props.classes)
        },

  methods: {
    refresh() {
      this.$nextTick(function () {
        console.log('yo')
      });
    },
  },
};
</script>

