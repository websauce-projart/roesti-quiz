<html>

<head>
    <title>Avatar Creation</title>
    <style>
        #container {
            background-color: cornflowerblue;

            display: flex;
            align-items: center;
            justify-content: center;

            height: 80vh;
            border: 1px solid black;
        }

        #avatarContainer {
            border: 1px solid black;
            position: relative;
            width: 94px;
            height: 94px;
        }

        .avatar {
            width: 100%;
            height: 100%;
            position: absolute;
            background-repeat: no-repeat;
        }

        #eyes {
            background-image: url('/storage/img/yeux.png');
        }

        #mouths {
            background-image: url('/storage/img/bouches.png');
        }

        #colors {
            background-image: url('/storage/img/couleurs.png');
        }

        #left {
            position: absolute;
            left: -30px;
            display: flex;
            flex-direction: column;
        }

        #right {
            position: absolute;
            left: 110px;
            display: flex;
            flex-direction: column;
        }

        #left>span,
        #right>span {
            margin-bottom: 3px;
            font-weight: bold;
            font-size: 1.75rem;
        }

        form {
            position: absolute;
            top: 500;
        }
    </style>
</head>


<body>

    <div id="container">
        <div id="avatarContainer">
            <div id="colors" class="avatar"></div>
            <div id="eyes" class="avatar"></div>
            <div id="mouths" class="avatar"></div>
            <div id="left">
                <span id="eyesLeft"><</span>
                <span id="mouthsLeft"><</span>
                <span id="colorsLeft"><</span>
            </div>
            <div id="right">
                <span id="eyesRight">></span>
                <span id="mouthsRight">></span>
                <span id="colorsRight">></span>
            </div>
        </div>
        <div>

        </div>

        <form action="" method="POST">
        @csrf

        <input type="hidden" id="eyeValue" name="eye" value="/storage/img/avatar/yeux1.png">
        <input type="hidden" id="mouthValue" name="mouth" value="/storage/img/avatar/bouches1.png">
        <input type="hidden" name="color" value="#FF0000">
        <input type="submit" id="submit" value="suivant">
        </form>
    </div>

    <script>
        
        /**Yeux */
        let eyesOffset = 0;
        let eyeValue = document.getElementById('eyeValue');
        let eyesRight = document.getElementById('eyesRight')
        let eyesLeft = document.getElementById('eyesLeft')
        eyesRight.addEventListener('click', function() {
            if (eyesOffset == -376) {
                eyesOffset = 0;
            } else {
                eyesOffset = eyesOffset - 94;
            }

            document.getElementById('eyes').style.backgroundPosition = eyesOffset + "px 0px";
            console.log(eyesOffset);
        })
        
        eyesLeft.addEventListener('click', function() {
            if (eyesOffset == 0) {
                eyesOffset = -376
            } else {
                eyesOffset = eyesOffset + 94;
            }

            document.getElementById('eyes').style.backgroundPosition = eyesOffset + "px 0px";
            console.log(eyesOffset);
        })

        let getEye = (eyesOffset) => {
            switch (eyesOffset) {
                case 0:
                    eyeValue.value = '/storage/img/avatar/yeux1.png';
                    break;
                case -94:
                    eyeValue.value = '/storage/img/avatar/yeux2.png';
                    break;
                case -188:
                    eyeValue.value = '/storage/img/avatar/yeux3.png';
                    break;
                case -282:
                    eyeValue.value = '/storage/img/avatar/yeux4.png';
                    break;
                case -376:
                    eyeValue.value = '/storage/img/avatar/yeux5.png';
                    break;
            }
        }

        /**Bouches */
        let mouthsOffset = 0;
        let mouthValue = document.getElementById('mouthValue');
        let mouthsRight = document.getElementById('mouthsRight')
        let mouthsLeft = document.getElementById('mouthsLeft')
        mouthsRight.addEventListener('click', function() {
            if (mouthsOffset == -376) {
                mouthsOffset = 0;
            } else {
                mouthsOffset = mouthsOffset - 94;
            }

            document.getElementById('mouths').style.backgroundPosition = mouthsOffset + "px 0px";
            console.log(mouthsOffset);
        })
        
        mouthsLeft.addEventListener('click', function() {
            if (mouthsOffset == 0) {
                mouthsOffset = -376
            } else {
                mouthsOffset = mouthsOffset + 94;
            }

            document.getElementById('mouths').style.backgroundPosition = mouthsOffset + "px 0px";
            console.log(mouthsOffset);
        })
        let getMouth = (mouthsOffset) => {
            switch (mouthsOffset) {
                case 0:
                    mouthValue.value = '/storage/img/avatar/bouches1.png';
                    break;
                case -94:
                    mouthValue.value = '/storage/img/avatar/bouches2.png';
                    break;
                case -188:
                    mouthValue.value = '/storage/img/avatar/bouches3.png';
                    break;
                case -282:
                    mouthValue.value = '/storage/img/avatar/bouches4.png';
                    break;
                case -376:
                    mouthValue.value = '/storage/img/avatar/bouches5.png';
                    break;
            }
        }


        /**Submit */
        document.getElementById('container').addEventListener('click', function() {
            getEye(eyesOffset);
            getMouth(mouthsOffset);
        })


    </script>
</body>

</html>