<template>
    <input-text v-for="card in 6"></input-text>
</template>

<script>
    import inputText from './components/inputText.vue';
    export default {
        components: {inputText}
    }
</script>