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

$existDiary = $connection->prepare("SELECT * FROM Diary WHERE Date = :date AND User_Id = :id;");
$existDiary->bindParam(':id', $userData["Id"]);
$existDiary->bindParam(':date', $userData["Date"]);
$existDiary->execute();
$diary = $existDiary->fetch();

if (is_array($diary)) {
    echo "404";
    exit();
}





$updateInformation = $connection->prepare("INSERT INTO Diary(User_Id, Text, Title, Date) VALUES(:id, :text, :title, :date)");
$updateInformation->bindParam(':id', $userData["Id"]);
$updateInformation->bindParam(':title', $userData["Title"]);
$updateInformation->bindParam(':text', $userData["Text"]);
$updateInformation->bindParam(':date', $userData["Date"]);
$updateInformation->execute();
echo "200";
?>