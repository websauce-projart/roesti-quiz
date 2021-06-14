@extends('template')

@section('title')
Modifier mon rösti
@endsection


@section('content')

<div class="container">

    <header class="header">
        <nav class="topnav">
            <a href="{{ route('profile', [$user->id]) }}" class="icon-arrow-left" aria-label="Retour"></a>
            <h1 class="pageTitle">Modifier mon rösti</h1>
        </nav>
    </header>

    <x-avatar-editor label="Modifier" route="{{route('updateAvatar', [$user->id])}}">
    </x-avatar-editor>

</div>

@endsection



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

    const moveElementRandom = (element, randomOffset) => {
        document.getElementById(element).style.backgroundPosition = randomOffset + "px 0px";
        return randomOffset;
    }

    const getValue = (data, offset) => {
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
            case width * 3:
                return data[3].id;
                break;
            case width * 4:
                return data[4].id;
                break;
            case width * 5:
                return data[5].id;
                break;
            case width * 6:
                return data[6].id;
                break;
            case width * 7:
                return data[7].id;
                break;
            case width * 8:
                return data[8].id;
                break;
            case width * 9:
                return data[9].id;
                break;
            case width * 10:
                return data[10].id;
                break;
        }
    }

    const getPosition = (element) => {
        switch (element) {
            case 1:
                return 0
                break;
            case 2:
                return -width;
                break;
            case 3:
                return -width * 2;
                break;
            case 4:
                return -width * 3;
                break;
            case 5:
                return -width * 4;
                break;
            case 6:
                return -width * 5;
                break;
            case 7:
                return -width * 6;
                break;
            case 8:
                return -width * 7;
                break;
            case 9:
                return -width * 8;
                break;
            case 10:
                return -width * 9;
                break;
            case 11:
                return -width * 10;
                break;
        }
    }

    /**Déclaration de variables */
    let width = 200;

    let eyes = <?php echo $eyes; ?>;
    let eyesOffset = 0;
    let eyesValue = document.getElementById('eyesValue');
    let eyesRight = document.getElementById('eyesRight');

    let mouths = <?php echo $eyes; ?>;
    let mouthsOffset = 0;
    let mouthsValue = document.getElementById('mouthsValue');
    let mouthsRight = document.getElementById('mouthsRight');

    let poses = <?php echo $eyes; ?>;
    let posesOffset = 0;
    let posesValue = document.getElementById('posesValue');
    let posesRight = document.getElementById('posesRight');

    /**Déplacement des assets */
    eyesRight.addEventListener('click', function() {
        eyesOffset = moveElement(eyes, 'eyes', eyesOffset);
    });
    mouthsRight.addEventListener('click', function() {
        mouthsOffset = moveElement(mouths, 'mouths', mouthsOffset);
    });
    posesRight.addEventListener('click', function() {
        posesOffset = moveElement(poses, 'poses', posesOffset);
    });

    /**Submit */
    document.getElementById('avatarEditor').addEventListener('click', function() {
        eyesValue.value = getValue(eyes, eyesOffset);
        mouthsValue.value = getValue(mouths, mouthsOffset);
        posesValue.value = getValue(poses, posesOffset);
    })

    /**Randomizer */
    const randomizerButton = document.getElementById('avatar-randomizer');
    const getRandomOffset = () => {
        return Math.floor(Math.random() * 11) * -200;
    }

    randomizerButton.addEventListener('click', function() {
        eyesOffset = moveElementRandom('eyes', getRandomOffset());
        eyesValue.value = getValue(eyes, eyesOffset);
        mouthsOffset = moveElementRandom('mouths', getRandomOffset());
        mouthsValue.value = getValue(mouths, mouthsOffset);
        posesOffset = moveElementRandom('poses', getRandomOffset());
        posesValue.value = getValue(poses, posesOffset);
    })

    /**Set actual avatar */
    window.addEventListener('load', function() {
        eyesOffset = moveElementRandom('eyes', getPosition(<?php echo $user->eye()->first()->id; ?>));
        console.log(eyesOffset);
        eyesValue.value = getValue(eyes, eyesOffset);
        mouthsOffset = moveElementRandom('mouths', getPosition(<?php echo $user->mouth()->first()->id; ?>));
        mouthsValue.value = getValue(mouths, mouthsOffset);
        posesOffset = moveElementRandom('poses', getPosition(<?php echo $user->pose()->first()->id; ?>));
        posesValue.value = getValue(poses, posesOffset);
    })
</script>
@endpush