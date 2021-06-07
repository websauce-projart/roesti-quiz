<template>
        <div class="card" style="width: 18rem;">
            <div class="card-body">
                <h5 class="card-title" v-text="thecardtitle"></h5>
                <p class="card-text" v-html="thecardbody"></p>
                <button @click="setTitle" class="btn btn--primary">Set Title</button>
                <button @click="setBody" class="btn btn-success">Set Body</button>
            </div>
        </div>
</template>

<script>
export default {
        data() {
            return {
                thecardtitle: 'The Card Title',
                thecardbody: 'Here we have some text. It is great text, that I can tell you.'
            }
        },
        methods: {
            setTitle() {
                this.thecardtitle = 'NEW card title!'
            },
            setBody() {
                this.thecardbody = 'Now we have <b>NEW</b> text. It is STILL great text, that I can tell you.'
            }
        }
    }
</script>

<style>

</style>