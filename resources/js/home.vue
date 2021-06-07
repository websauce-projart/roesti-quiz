<template>
<navbar></navbar>
<game-home></game-home>
</template>

<script>
    import navbar from './elements/nav.vue';
	import inputText from './components/inputText.vue';
	import gameHome from './components/gameHome.vue';
    export default {
        components: {navbar, inputText, gameHome}
		}
</script>

