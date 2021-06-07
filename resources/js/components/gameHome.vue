<template>
<div>
    <p>Pseudo</p>
        <div>
            <p>À toi de jouer ou N'a pas encore relevé ton défi...</p>
            <form method="POST" action="{{ route('getresults') }}" accept-charset="UTF-8">
                @csrf
                <input type="hidden" name="game_id" value="{{$gamedata['game']->id}}">
                <input type="submit" value="->">
            </form>
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