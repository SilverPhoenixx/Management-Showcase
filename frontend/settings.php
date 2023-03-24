<?php
require_once("backend/database/Database.php");
use Management\Database;

$database = new Database();
$pdo = $database->getPDO();


$stmtUser = $pdo->query("SELECT * FROM User WHERE Name = '$name'");
$user = $stmtUser->fetch();

if($user != true) {
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
    <title>User - Settings</title>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=MedievalSharp" />
    <link rel="stylesheet" type="text/css" href="/frontend/css/style.css" />
    <script src="/frontend/js/settings.js"></script>
</head>
<body>
<?php require_once("components/Navbar.php") ?>
<hr class="p-border-red border-5">
<div class="p-background-light-black">
    <div class="container-fluid p-container m-0 p-0 pt-3">
        <div class="row justify-content-center m-0">
            <div class="col-6 p-0 justify-content-center">

                <div class="row justify-content-center">
                    <div class="col-12 text-center">
                        <span class="display-4 p-text-grayish-white">Statistiken</span>
                    </div>


                    <div class='col col-8 pb-3'>
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Aktivität</span>
                            <input type='text' class='form-control' aria-label='Activity' aria-describedby='Activity' id="newActivity">
                            <input id="addActivity" type='button' class='form-control p-background-red p-text-white' value="Hinzufügen" style="border: none" aria-label="Add Activity" aria-describedby="Add Activity" onclick="addActivity()">
                        </div>
                    </div>

                    <?php

                    foreach ($activities as $activity) {
                        echo "<div class='col-8 p-text-grayish-white'>
                        {$activity['Name']}
                      </div>
                      <div class='col col-8 pb-3'>
                        <div class='input-group mb-3'>
                        <span class='input-group-text' id='percent{$activity['Name']}'>{$activity['Percent']} %</span>
                        <input id='range{$activity['Name']}' data-activityName='{$activity['Name']}' type='range' max='100' min='0' step='1' class='form-control activity' placeholder='1-100' aria-label='Percent Value' aria-describedby='Percent Value' value='{$activity['Percent']}'>
                     
                           </div>
                    </div>";
                    }
                    ?>


                    <div class="col-12 text-center">
                        <span class="display-4 p-text-grayish-white">Beschreibung</span>
                    </div>
                    <div class="col col-8 pb-5">
                            <textarea id="Description" class="form-control" rows="3" placeholder="Beschreibung der Sklavin, in Worten"><?php echo $user["Description"] ?></textarea>
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
                    <div class="col-8 text-center p-text-grayish-white pt-3">
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Name</span>
                            <input id="Name" type='text' class='form-control' value="<?php echo $user["Name"] ?>" aria-label="Name" aria-describedby="Name">
                        </div>
                    </div>
                    <div class="col-8 text-center p-text-grayish-white">
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Rank</span>
                            <input id="Rank" type='text' class='form-control' value="<?php echo $user["Rankname"] ?>" aria-label="Rank" aria-describedby="Rank">
                        </div>
                    </div>
                    <div class="col-8 text-center p-text-grayish-white">
                            <div class='input-group mb-3'>
                                <span class='input-group-text'>Level</span>
                                <input id="Level" type='number' class='form-control' value="<?php echo $user["Level"] ?>" aria-label="Level" aria-describedby="Level">
                            </div>
                    </div>
                    <div class="col-8 text-center p-text-grayish-white">
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Erfahrung</span>
                            <input id="Exp" type='number' class='form-control' value="<?php echo $user["EXP"] ?>" aria-label="Exp" aria-describedby="Exp">
                        </div>
                    </div>
                    <div class="col-8 text-center p-text-grayish-white">
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Bild</span>
                            <input id="Image" type='text' class='form-control' value="<?php echo $user["Image"] ?>" aria-label="Image" aria-describedby="Image">
                        </div>
                    </div>
                    <div class="col-8 text-center p-text-grayish-white">
                        <div class='input-group mb-3'>
                            <input id="Submit" type='button' class='form-control p-background-red p-text-white' value="Speichern" style="border: none" aria-label="Submit" aria-describedby="Submit" onclick="updateSlaveSettings()">
                        </div>
                    </div>
                    <input type="number" id="Id" value="<?php echo $user["User_Id"] ?>" hidden>
                </div>
            </div>
            <div class="col col-6 p-0">
                <div class="row justify-content-center p-0 m-0">
                    <div class="col-8 text-center">
                        <span class="display-4 p-text-grayish-white">Aufgaben</span>
                    </div>
                    <div class="col-8">
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Quest</span>
                            <input id="newQuestName" type='text' class='form-control' placeholder="Neue Aufgabe" aria-label="New Quest" aria-describedby="New Quest">
                         </div>
                        <div class='input-group mb-3'>
                            <span class='input-group-text'>Type</span>
                            <select class="form-select" value="daily" id="newQuestType">
                                <option value="daily">Täglich</option>
                                <option value="weekly">Wöchentlich</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-8">
                        <div class='input-group mb-3'>
                            <input id="submitNewQuest" type='button' class='form-control p-background-red p-text-white' value="Hinzufügen" style="border: none" aria-label="submitNewQuest" aria-describedby="submitNewQuest" onclick="addQuest()">
                        </div>
                    </div>
                    <?php
                    $stmtQuestList = $pdo->query("SELECT * FROM QuestList");
                    $quests = $stmtQuestList->fetchAll();

                    foreach ($quests as $quest) {
                        echo "<div class='col-8'>
                        <div class='input-group mb-3'>
                            <span class='form-control'>{$quest["Name"]}</span>
                                                     <span class='form-control'>{$quest["Type"]}</span>
                            <input type='button' class='form-control p-background-red p-text-white' value='Löschen' style='border: none' aria-label='deleteQuest' aria-describedby='deleteQuest' onclick='deleteQuest({$quest["Quest_Id"]})'>
                        </div>
                    </div>";
                    }
                    ?>
                </div>
            </div>
            <div class="col col-6 p-0">
            </div>
        </div>
    </div>
</div>
</body>
</html>