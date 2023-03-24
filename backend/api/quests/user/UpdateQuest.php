<?php


if(!isset($_POST)) {
    echo "Es wurden keine Daten festgelegt.";
    return;
}

require_once("backend/database/Database.php");
use Management\Database;

$database = new Database();
$connection = $database->getPDO();
$_POST = json_decode(file_get_contents('php://input'), true);
$userData = $_POST[0];

$existDailyQuest = $connection->prepare("SELECT * FROM CompleteQuestList WHERE Quest_Id = (SELECT Quest_Id FROM QuestList WHERE Name = :quest_name AND Type = :quest_type) AND Date = :date AND User_Id = :user_id;");
$existDailyQuest->bindParam(':user_id', $userData["Id"]);
$existDailyQuest->bindParam(":quest_name", $userData["Quest_Name"]);
$existDailyQuest->bindParam(":quest_type", $userData["Quest_Type"]);
$existDailyQuest->bindParam(':date', $userData["Date"]);
$existDailyQuest->execute();
$dailyQuest = $existDailyQuest->fetch();

print_r($userData);

if (!is_array($dailyQuest)) {
    $completed = true;
    $insertDailyQuest = $connection->prepare("INSERT INTO CompleteQuestList(User_Id, Quest_Id, Date, Completed) VALUES(:user_id, (SELECT Quest_Id FROM QuestList WHERE Name = :quest_name AND Type = :quest_type), :date, :completed)");
    $insertDailyQuest->bindParam(':user_id', $userData["Id"]);
    $insertDailyQuest->bindParam(':quest_name', $userData["Quest_Name"]);
    $insertDailyQuest->bindParam(':quest_type', $userData["Quest_Type"]);
    $insertDailyQuest->bindParam(':date', $userData["Date"]);
    $insertDailyQuest->bindParam(':completed', $completed);
    $insertDailyQuest->execute();
    echo "200";
    exit();
}

$updateInformation = $connection->prepare("UPDATE CompleteQuestList SET Completed = !Completed WHERE User_Id = :user_id AND Quest_Id = (SELECT Quest_Id FROM QuestList WHERE Name = :quest_name AND Type = :quest_type) AND Date = :date");
$updateInformation->bindParam(':user_id', $userData["Id"]);
$updateInformation->bindParam(':quest_name', $userData["Quest_Name"]);
$updateInformation->bindParam(':quest_type', $userData["Quest_Type"]);
$updateInformation->bindParam(':date', $userData["Date"]);
$updateInformation->execute();
echo "200";
exit();
?>