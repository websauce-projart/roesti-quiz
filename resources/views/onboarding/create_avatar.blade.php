@extends('template')

@section('title')
Créer mon rösti
@endsection

@section('content')
<div class="container">
	<div class="unboarding">
		<h1 class="unboarding__title">Quel rösti es-tu, {{$pseudo}} ?</h1>
	</div>

	<x-avatar-editor label="Suivant" route=""></x-avatar-editor>

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
</script>
@endpush
