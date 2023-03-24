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

$existQuests = $connection->prepare("SELECT * FROM QuestList WHERE Name = :quest_name AND Type = :quest_type;");
$existQuests->bindParam(':quest_name', $userData["Quest_Name"]);
$existQuests->bindParam(':quest_type', $userData["Quest_Type"]);
$existQuests->execute();
$quests = $existQuests->fetch();

if (is_array($quests)) {
    echo "404";
    exit();
}





$addQuest = $connection->prepare("INSERT INTO QuestList(Name, Type, Description) VALUES(:quest_name, :quest_type, 'None')");
$addQuest->bindParam(':quest_name', $userData["Quest_Name"]);
$addQuest->bindParam(':quest_type', $userData["Quest_Type"]);
$addQuest->execute();
echo "200";
?>