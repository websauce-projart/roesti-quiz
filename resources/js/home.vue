<template>
    <game-home></game-home>
</template>

<script>
    import GameHome from './components/gameHome.vue'
    export default {
        components: {
                GameHome
            },
        props:[
            'classes',
            ],
        setup(props) {
            console.log(props.classes)
        }
    }
</script>