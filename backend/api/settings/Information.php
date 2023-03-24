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

$updateInformation = $connection->prepare("UPDATE User SET Image = :image, Name = :name, Rankname = :rank, Exp = :exp, Description = :description, Level = :level WHERE User_Id = :id");
$updateInformation->bindParam(':id', $userData["Id"]);
$updateInformation->bindParam(':rank', $userData["Rank"]);
$updateInformation->bindParam(':level', $userData["Level"]);
$updateInformation->bindParam(':name', $userData["Name"]);
$updateInformation->bindParam(':description', $userData["Description"]);
$updateInformation->bindParam(':exp', $userData["Exp"]);
$updateInformation->bindParam(':image', $userData["Image"]);
$updateInformation->execute();

foreach (json_decode($userData["Activities"]) as $activity) {
    $updateInformation = $connection->prepare("UPDATE Activity SET Percent = :percent WHERE User_Id = :id AND Activity = :activity");
    $updateInformation->bindParam(':id', $userData["Id"]);
    $updateInformation->bindParam(':activity', $activity->Name);
    $updateInformation->bindParam(':percent', $activity->Percent);
    $updateInformation->execute();
}


echo "200";
?>