<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User - Profile</title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
            integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
            integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD"
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=MedievalSharp"/>
    <link rel="stylesheet" type="text/css" href="/frontend/css/style.css"/>
</head>
<body>
<nav class="navbar navbar-expand-lg p-background-black">
    <div class="container-fluid">
        <a class="navbar-brand" href="/entrance">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon navbar-dark"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 tw">
                <li class="nav-item">
                    <a class="nav-link p-color-red" aria-current="page" href="/">Entrance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-text-white" href="/profile/Tony">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-text-white" href="/diary/Tony/1">Diary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-text-white" href="/quests/Tony/<?php echo date("d.m.Y") ?>">Quests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-text-white" href="/settings/Tony">Settings</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<hr class="p-border-red border-5">
<div class="container-fluid p-container m-0 p-0 pt-3 p-background-light-black">
    <div class="row justify-content-center m-0">
        <div class="col col-6 p-0 justify-content-center">

            <div class="row justify-content-center">
                <div class="col-12">
                    <span class="display-5 p-text-grayish-white">Work in Progress</span>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>