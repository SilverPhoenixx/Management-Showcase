<?php
require_once("backend/database/Database.php");
use Management\Database;

$database = new Database();
$pdo = $database->getPDO();


$stmtUser = $pdo->query("SELECT * FROM User WHERE Name = '$name'");
$user = $stmtUser->fetch();

if ($user != true) {
    header("Location: ../entrance");
    exit();
}

$stmtActivity = $pdo->query("SELECT * FROM Activity WHERE User_Id = " . $user["User_Id"]);
$activities = $stmtActivity->fetchAll();


?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User - Profile</title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=MedievalSharp" />
    <link rel="stylesheet" type="text/css" href="/frontend/css/style.css" />
</head>
<body>
<?php require_once("components/Navbar.php") ?>
<hr class="p-border-red border-5">
<div class="container-fluid p-container m-0 p-0 pt-3 p-background-light-black">
    <div class="row justify-content-center m-0">
        <div class="col col-6 p-0 justify-content-center">

            <div class="row justify-content-center">

                <div class="col-12 text-center">
                    <span class="display-4 p-text-grayish-white">Statistiken</span>
                </div>

                <?php

                foreach ($activities as $activity) {
                    echo "<div class='col-8 p-text-grayish-white'>
                        {$activity['Name']}
                      </div>
                      <div class='col col-8 pb-3'>
                        <div class='progress' role='progressbar' aria-label='Danger example' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100'>
                            <div class='progress-bar p-background-red' style='width:        {$activity['Percent']}%'>        {$activity['Percent']}%</div>
                        </div>
                        </div>";
                }
                ?>

                <div class="col-12 text-center">
                    <span class="display-4 p-text-grayish-white">Beschreibung</span>
                </div>
                <div class="col col-8 pb-5 p-text-grayish-white">
                    <?php echo $user["B_Description"] ?>
                </div>
            </div>
        </div>
        <div class="col col-6 p-0">
            <div class="row justify-content-center p-0 m-0">
                <div class="col-7 justify-content-center">
                    <div class="row justify-content-center">
                        <div class="col-7 p-text-grayish-white">
                            <img src="/frontend/images/<?php echo $user["Image"] ?>.jpg" class="img-fluid rounded-circle float-start" alt="Slave image">
                        </div>
                    </div>
                </div>
                <div class="col-8 text-center p-text-grayish-white">
                    <span class="display-5"><?php echo $user["Name"] ?></span>
                </div>
                <div class="col-8 text-center p-text-grayish-white">
                    <span class="fs-5"><?php echo $user["Rankname"] ?></span>
                </div>
                <div class="col-8 text-center p-text-grayish-white">
                    <span class="fs-5">LvL. <?php echo $user["Level"] ?></span>
                </div>
                <div class="col-7">
                    <div class="progress" role="progressbar" aria-label="Danger example" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100">
                        <div class="progress-bar p-background-red" style="width: <?php echo $user["EXP"] ?>%"> <?php echo $user["EXP"] ?>%</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>