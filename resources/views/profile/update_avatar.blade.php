@extends('/home/template_home')

@section('title')
RöstiQuiz - Modifier mon avatar
@endsection

@push('css')
<style>
    /** GRID SETTINGS */
    #avatarEditor {
        display: grid;
        grid-template-columns: 1fr;
        grid-template-rows: auto 1fr;
        grid-template-areas:
            "buttons"
            "avatar"
    }

    #buttonContainer {
        grid-area: buttons;
    }

    #avatarContainer {
        grid-area: avatar;
    }

    /**AVATAR SETTINGS */
    #avatarContainer {
        position: relative;
        width: 200px;
        height: 200px;
        background-image: url('/img/avatar/assets_avatar_background.svg');
        margin: 0 auto;
    }

    .avatar {
        width: 100%;
        height: 100%;
        position: absolute;
    }

    #eyes {
        background-image: url('/img/avatar/eyes/assets_avatar_yeux.png');
    }

    #mouths {
        background-image: url('/img/avatar/mouths/assets_avatar_bouches.png');
    }

    #poses {
        background-image: url('/img/avatar/poses/assets_avatar_poses.png');
    }

    /**BUTTONS SETTINGS */
    #buttonsContainer {
        display: flex;
        align-items: center;
        justify-content: space-evenly;
    }

    #buttonsContainer > span {
        font-size: 10rem;
    }
</style>
@endpush

@push('script')
<script>
    /**Fonctions */
    const moveElement = (data, element, offset) => {
        let newOffset;
        if (offset == data.length * -(width) + width) {
            newOffset = 0;
        } else {
            newOffset = offset - width;
        }
        document.getElementById(element).style.backgroundPosition = newOffset + "px 0px";
        return newOffset;
    }

    // const leftButton = (data, element, offset) => {
    //     let newOffset;
    //     if (offset == data.length * (width) - width) {
    //         newOffset = 0;
    //     } else {
    //         newOffset = offset + width;
    //     }
    //     document.getElementById(element).style.backgroundPosition = newOffset + "px 0px";
    //     return newOffset;
    // }

    const getValue = (data, offset) => {
        console.log(Math.abs(offset));
        switch (Math.abs(offset)) {
            case 0:
                return data[0].id;
                break;
            case width:
                return data[1].id;
                break;
            case width * 2:
                return data[2].id;
                break;
        }
    }

    /**Déclaration de variables */
    let width = 200;

    let eyes = <?php echo $eyes; ?>;
    let eyesOffset = 0;
    let eyesValue = document.getElementById('eyesValue');
    let eyesRight = document.getElementById('eyesRight');
    // let eyesLeft = document.getElementById('eyesLeft');

    let mouths = <?php echo $eyes; ?>;
    let mouthsOffset = 0;
    let mouthsValue = document.getElementById('mouthsValue');
    let mouthsRight = document.getElementById('mouthsRight');
    // let mouthsLeft = document.getElementById('mouthsLeft');

    let poses = <?php echo $eyes; ?>;
    let posesOffset = 0;
    let posesValue = document.getElementById('posesValue');
    let posesRight = document.getElementById('posesRight');
    // let posesLeft = document.getElementById('posesLeft');

    /**Déplacement des assets */
    eyesRight.addEventListener('click', function() {
        eyesOffset = moveElement(eyes, 'eyes', eyesOffset);
    });
    mouthsRight.addEventListener('click', function() {
        mouthsOffset = moveElement(mouths, 'mouths', mouthsOffset);
    });
    posesRight.addEventListener('click', function() {
        posesOffset = moveElement(poses, 'poses', posesOffset);
        console.log(posesOffset)
    });

    // eyesLeft.addEventListener('click', function() {
    //     eyesOffset = leftButton(eyes, 'eyes', eyesOffset);
    // });
    // mouthsLeft.addEventListener('click', function() {
    //     mouthsOffset = leftButton(mouths, 'mouths', mouthsOffset);
    // });
    // posesLeft.addEventListener('click', function() {
    //     posesOffset = leftButton(poses, 'poses', posesOffset);
    //     console.log(posesOffset)
    // });

    /**Submit */

    document.getElementById('avatarEditor').addEventListener('click', function() {
        eyesValue.value = getValue(eyes, eyesOffset);
        mouthsValue.value = getValue(mouths, mouthsOffset);
        posesValue.value = getValue(poses, posesOffset);
    })
</script>
@endpush

@section('contenu')
<x-avatar-editor label="Modifier" route="{{route('updateAvatar')}}"></x-avatar-editor>
@endsection
