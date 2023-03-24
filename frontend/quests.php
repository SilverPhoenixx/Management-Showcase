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
?>
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
    <script src="/frontend/js/quests.js"></script>
</head>
<body>
<?php require_once("components/Navbar.php") ?>
<hr class="p-border-red border-5">
<div class="container-fluid p-container m-0 p-0 pt-3 p-background-light-black">
    <div class="row justify-content-center m-0">
        <div class="col col-11 p-0 justify-content-center">
            <div class="row">
                <div class="col-12">
                    <span class="display-4 p-text-grayish-white"><?php echo $user["Name"] ?>'s Aufgaben</span>
                </div>
                <div class="col-12">
                    <?php

                    if (strlen(explode(".", $date)[2]) != 4) {
                        header("Location: /entrance");
                        exit();
                    }

                    $yesterday = date('d.m.Y', strtotime($date . ' - 1 days'));
                    $tomorrow = date('d.m.Y', strtotime($date . ' + 1 days'));
                    ?>
                    <div class="row">
                        <div class="col-4 text-start">
                            <a class="text-decoration-none p-text-grayish-white" href="./<?php echo $yesterday ?>">
                                <button type="button" class="btn p-background-red p-text-grayish-white">Gestern</button>
                            </a>
                        </div>
                        <div class="col-4 text-center">
                            <a class="text-decoration-none p-text-grayish-white" href="./<?php echo $date ?>">
                                <button type="button" class="btn p-background-red p-text-grayish-white">Heute</button>
                            </a>
                        </div>
                        <div class="col-4 text-end">
                            <a class="text-decoration-none p-text-grayish-white" href="./<?php echo $tomorrow ?>">
                                <button type="button" class="btn p-background-red p-text-grayish-white">Morgen</button>
                            </a>

                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="row p-text-grayish-white pt-3">
                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <span class="display-5">Wöchentliche Aufgaben</span>
                                </div>
                                <div class="col-12">
                                    <?php
                                    $stmtDailyQuest = $pdo->prepare("SELECT * FROM QuestList WHERE Quest_Id NOT IN (SELECT Quest_Id FROM CompleteQuestList WHERE User_Id = :user_id AND Date = :date) AND Type = 'weekly';");
                                    $stmtDailyQuest->bindValue(":user_id", $user["User_Id"]);
                                    $stmtDailyQuest->bindValue(":date", $date);
                                    $stmtDailyQuest->execute();
                                    $quests = $stmtDailyQuest->fetchAll();


                                    foreach ($quests as $quest) {
                                        $function = 'updateQuest("' . $quest["Name"] . '", "' . $date . '","weekly")';

                                        echo "<div class='form-check'>
                                        <input class='form-check-input' type='checkbox' id='flexCheckChecked' onclick='$function'>
                                        <label class='form-check-label' for='flexCheckChecked'>
                                            {$quest["Name"]}
                                        </label>
                                    </div>";
                                    }

                                    $stmtDailyQuestComplete = $pdo->prepare("SELECT Name, Completed FROM CompleteQuestList INNER JOIN QuestList ON CompleteQuestList.Quest_Id = QuestList.Quest_Id AND QuestList.Type = 'weekly' WHERE User_Id = :user_id AND Date = :date ORDER BY Completed;");
                                    $stmtDailyQuestComplete->bindValue(":user_id", $user["User_Id"]);
                                    $stmtDailyQuestComplete->bindValue(":date", $date);
                                    $stmtDailyQuestComplete->execute();
                                    $questsCompleted = $stmtDailyQuestComplete->fetchAll();


                                    foreach ($questsCompleted as $questComplete) {
                                        $function = 'updateQuest("' . $questComplete["Name"] . '", "' . $date . '","daily")';
                                        $checked = $questComplete["Completed"] ? "checked" : "";
                                        echo "<div class='form-check'>
                                        <input class='form-check-input' type='checkbox' id='flexCheckChecked' onclick='$function' $checked>
                                        <label class='form-check-label' for='flexCheckChecked'>
                                            {$questComplete["Name"]}
                                        </label>
                                    </div>";
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="row">
                                <div class="col-12">
                                    <span class="display-5">Tägliche Aufgaben</span>
                                </div>
                                <div class="col-12">
                                    <?php
                                    $stmtDailyQuest = $pdo->prepare("SELECT * FROM QuestList WHERE Quest_Id NOT IN (SELECT  Quest_Id FROM CompleteQuestList WHERE User_Id = :user_id AND Date = :date) AND Type = 'daily';");
                                    $stmtDailyQuest->bindValue(":user_id", $user["User_Id"]);
                                    $stmtDailyQuest->bindValue(":date", $date);
                                    $stmtDailyQuest->execute();
                                    $quests = $stmtDailyQuest->fetchAll();


                                    foreach ($quests as $quest) {
                                        $function = 'updateQuest("' . $quest["Name"] . '", "' . $date . '","daily")';

                                        echo "<div class='form-check'>
                                        <input class='form-check-input' type='checkbox' id='flexCheckChecked' onclick='$function'>
                                        <label class='form-check-label' for='flexCheckChecked'>
                                            {$quest["Name"]}
                                        </label>
                                    </div>";
                                    }

                                    $stmtDailyQuestComplete = $pdo->prepare("SELECT Name, Completed FROM CompleteQuestList INNER JOIN QuestList ON CompleteQuestList.Quest_Id = QuestList.Quest_Id AND QuestList.Type = 'daily' WHERE User_Id = :user_id AND Date = :date ORDER BY Completed;");
                                    $stmtDailyQuestComplete->bindValue(":user_id", $user["User_Id"]);
                                    $stmtDailyQuestComplete->bindValue(":date", $date);
                                    $stmtDailyQuestComplete->execute();
                                    $questsCompleted = $stmtDailyQuestComplete->fetchAll();


                                    foreach ($questsCompleted as $questComplete) {
                                        $function = 'updateQuest("' . $questComplete["Name"] . '", "' . $date . '","daily")';
                                        $checked = $questComplete["Completed"] ? "checked" : "";
                                        echo "<div class='form-check'>
                                        <input class='form-check-input' type='checkbox' id='flexCheckChecked' onclick='$function' $checked>
                                        <label class='form-check-label' for='flexCheckChecked'>
                                            {$questComplete["Name"]}
                                        </label>
                                    </div>";
                                    }
                                    ?>
                                </div>
                                <input type="text" id="Id" value="<?php echo $user["User_Id"] ?>" hidden>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>