<?php 
$name = $_POST["name"] ;
$eventname = "Oktoberfest" ;
$date = "September";
$generationdate = "00/00/0000";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .link {
            text-decoration-line: underline;
        }
        .link:hover {
            color:red;
        }
        </style>
</head>
<body>
    <h1>
        <?= $name?> <br>
        <?= $eventname?><br>
        <?= $date?> <br>
        <?= $generationdate?><br>
    </h1>
    <a onclick="print()" class="link">Imprimer le ticket</a><br>
    <a href="index.php"> Go back </a>
</body>
</html>