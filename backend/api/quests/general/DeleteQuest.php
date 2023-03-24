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

$deleteQuest = $connection->prepare("DELETE FROM QuestList WHERE Quest_Id = :quest_id");
$deleteQuest->bindParam(':quest_id', $userData["Quest_Id"]);
$deleteQuest->execute();

$deleteUserQuest = $connection->prepare("DELETE FROM CompleteQuestList WHERE Quest_Id = :quest_id");
$deleteUserQuest->bindParam(':quest_id', $userData["Quest_Id"]);
$deleteUserQuest->execute();

echo "200";
?>