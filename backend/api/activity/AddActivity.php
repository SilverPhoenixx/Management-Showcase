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

$existActivity = $connection->prepare("SELECT * FROM Activity WHERE Name = :name AND User_Id = :id;");
$existActivity->bindParam(':id', $userData["Id"]);
$existActivity->bindParam(':name', $userData["Name"]);
$existActivity->execute();
$activity = $existActivity->fetch();

if (is_array($activity)) {
    echo "404";
    exit();
}


$updateInformation = $connection->prepare("INSERT INTO Activity(Name, User_Id) VALUES(:activity, :id)");
$updateInformation->bindParam(':id', $userData["Id"]);
$updateInformation->bindParam(':name', $userData["Name"]);
$updateInformation->execute();

echo "200";
exit();
?>