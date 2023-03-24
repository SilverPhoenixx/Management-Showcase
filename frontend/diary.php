<?php

use Management\Database;

require_once("backend/database/Database.php");

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js" integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=MedievalSharp" />
    <link rel="stylesheet" type="text/css" href="/frontend/css/style.css" />
    <script src="/frontend/js/diary.js"></script>
</head>
<body>
<?php require_once("components/Navbar.php") ?>
<hr class="p-border-red border-5">
    <div class="container-fluid p-container m-0 p-0 pt-3 p-background-light-black">
        <div class="row justify-content-center m-0">
            <div class="col col-11 p-0 justify-content-center">
                    <div class="row">
                        <div class="col-6">
                            <span class="display-4 p-text-grayish-white"><?php echo $user["Name"] ?>'s Tagebuch</span>
                        </div>
                        <div class="col-6">
                            <div class="row">
                                <?php
                                $lastPage = $page > 1 ? $page -1 : 1;
                                $nextPage = $page+1;
                                ?>
                                <div class="col-4">
                                    <a class="text-decoration-none p-text-grayish-white" href="./<?php echo $lastPage ?>"><button type="button" class="btn p-background-red p-text-grayish-white">Vorherige Seite</button></a>
                                </div>
                                <div class="col-4 text-center">
                                   <a class="text-decoration-none p-text-grayish-white" href="./<?php echo $page ?>"> <button type="button" class="btn p-background-red p-text-grayish-white">Seite <?php echo $page ?></button></a>
                                </div>
                                <div class="col-4 text-end">
                                    <a class="text-decoration-none p-text-grayish-white" href="./<?php echo $nextPage ?>"><button type="button" class="btn p-background-red p-text-grayish-white">Nächste Seite</button></a>


                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                        </div>
                        <div class="col-6">
                            <div class='input-group mb-3'>
                                <span class='input-group-text'>Datum</span>
                                <input type='date' class='form-control' placeholder='dd.mm.yyyy' aria-label='Datum' aria-describedby='Datum' id="date">
                                <span class='input-group-text'>Titel</span>
                                <input type='text' class='form-control' placeholder='Titel' aria-label='Titel' aria-describedby='Titel' id="title">
                            </div>
                            <div class='input-group mb-3'>
                                <span class='input-group-text'>Text</span>
                                <textarea rows="5" class='form-control' aria-label='Text' aria-describedby='Text' id="text"></textarea>
                            </div>
                            <div class='input-group mb-3'>
                                <input type='button' class='form-control p-background-red p-text-grayish-white' style="border: none" value="Eintrag hinzufügen" aria-label='submit' aria-describedby='Text' id="submit" onclick="addDiaryEntry()">
                            </div>
                            <input id="Id" type="text" value="<?php echo $user["User_Id"] ?>" hidden>
                        </div>
                        <div class="col-12">
                            <div class="row p-text-grayish-white">
                                <hr class="p-border-red border-5 pb-3">
                                
                                <?php
                                $limit = 25;
                                $offset = $page * 25 - 25;
                                $stmtDiary = $pdo->query("SELECT * FROM Diary WHERE User_Id = " . $user["User_Id"] . " ORDER BY DATE DESC LIMIT $limit OFFSET $offset");
                                $diaries = $stmtDiary->fetchAll();


                                foreach ($diaries as $diary) {
                                    echo "<div class='col-12'>
                                    <span class='fs-1'>{$diary["Title"]}</span>
                                    <br>
                                    <span class='fs-3'>{$diary["Date"]}</span>
                                </div>
                                <div class='col-12 fs-5'>
                                    {$diary["Text"]}
                                </div>
                                <div class='col-10'></div>
                                <div class='col-2 pb-3'><input type='button' class='form-control p-background-red p-text-grayish-white' value='Löschen' style='border: none' onclick='deleteDiary({$diary["Diary_Id"]})'></div>
                                <hr class='p-border-red border-5'>";
                                }
                               ?>
                        </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>