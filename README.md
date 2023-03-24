# Informationen

Kleines Projekt für meine Freundin um sich selber in bestimmten Aktvitäten einschätzen zu können sowie
sich mit EXP und Level spielerisch belohnen zu können.
Mit integrierten Tagebuch, damit sie Tätigkeiten und Gedanken, auf die sie Wert legt, dokumentieren kann.

Datenbanken (Es wurde PlanetScale für das Hosten der Datenbanken verwendet, da es sich um ein Privatprojekt handelt. Die Seite lässt keine Fremdschlüssel zu.)

1. CREATE TABLE `Activity` (
   `Activity_Id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `User_Id` int NOT NULL,
   `Activity` varchar(64) NOT NULL,
   `Percent` varchar(3));

2. CREATE TABLE `CompleteQuestList` (
   `CQuest_Id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `User_Id` int NOT NULL,
   `Quest_Id` int NOT NULL,
   `Date` varchar(12) NOT NULL,
   `Completed` tinyint(1) NOT NULL DEFAULT '0');

3. CREATE TABLE `Diary` (
   `Diary_Id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `User_Id` int NOT NULL,
   `Title` varchar(64) NOT NULL,
   `Date` varchar(32) NOT NULL,
   `Text` varchar(4096) NOT NULL);

4. CREATE TABLE `QuestList` (
   `Quest_Id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `Name` varchar(64) NOT NULL,
   `Type` varchar(64) NOT NULL,
   `Description` varchar(64) NOT NULL);

5. CREATE TABLE `User` (
   `User_Id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
   `Name` varchar(32) NOT NULL,
   `Rank` varchar(32) NOT NULL,
   `Level` varchar(32) NOT NULL,
   `EXP` varchar(3),
   `Description` varchar(2048),
   `Image` varchar(64));