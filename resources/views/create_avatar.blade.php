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
        }

        #yeux {
            background-image: url('/storage/img/yeux.png');
        }

        #bouches {
            background-image: url('/storage/img/bouches.png');
        }

        #couleurs {
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

        #left > span,
        #right > span {
            margin-bottom: 3px;
            font-weight: bold;
            font-size: 1.75rem;
        }

    </style>
</head>


<body>

    <div id="container">
        <div id="avatarContainer">
            <div id="couleurs" class="avatar"></div>
            <div id="yeux" class="avatar"></div>
            <div id="bouches" class="avatar"></div>
            <div id="left">
                <span id="yeuxLeft"><</span>
                <span id="bouchesLeft"><</span>
                <span id="couleursLeft"><</span>
            </div>
            <div id="right">
                <span id="yeuxRight">></span>
                <span id="bouchesRight">></span>
                <span id="couleursRight">></span>
            </div>
        </div>
        <div>
            
        </div>
    </div>

    <script>
        let yeuxRight = document.getElementById('yeuxRight');
        yeuxRight.addEventListener('click', function() {
            
        })

    </script>
</body>

</html>