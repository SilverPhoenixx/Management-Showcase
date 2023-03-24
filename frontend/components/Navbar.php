<nav class="navbar navbar-expand-lg p-background-black">
    <div class="container-fluid">
        <a class="navbar-brand" href="/entrance">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon navbar-dark"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 tw">
                <li class="nav-item">
                    <a class="nav-link p-text-white" aria-current="page" href="/">Entrance</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-text-white" href="/profile/<?php echo $user["Name"] ?>">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-text-white" href="/diary/<?php echo $user["Name"] ?>/1">Diary</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-text-white" href="/quests/<?php echo $user["Name"] . "/" . date("d.m.Y") ?>">Quests</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link p-color-red" href="/settings/<?php echo $user["Name"] ?>">Settings</a>
                </li>
            </ul>
        </div>
    </div>
</nav>