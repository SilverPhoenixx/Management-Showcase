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

$updateInformation = $connection->prepare("DELETE FROM Activity WHERE Activity_Id = :id");
$updateInformation->bindParam(':id', $userData["Activity_Id"]);
$updateInformation->execute();
echo "200";
?>