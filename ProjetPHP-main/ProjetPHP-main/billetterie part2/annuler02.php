<?php

session_start();


require_once("../authentification/config.php");
require_once("token.php");

$event = null;

if (isset($_COOKIE["validate"]) && $_COOKIE["validate"] == true) {


    // Préparation de la requête
    $pdoStat = $pdo-> prepare("DELETE FROM event LIMIT 1");

    // Liaison du paramètre nommé
    $pdoStat ->bindValue($_GET['name'], PDO::PARAM_INT);


    // Exécution de la requête
    $executeIsOK = $pdoStat->execute();

    if($executeIsOK){

        global $event;
        $event = "L'évènement a bien été supprimé.";

    }

    else{
        global $event;
        $event = "Echec de la suppression.";
    }

}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Annuler un évènement</title>
    <link rel="stylesheet" type="" href="../assets/styles/style1.css">
    <style>
        .form img {
      position: absolute;
      width: 40px;
      height: 40px;
    }
     h1 {
      margin-top: -32px;
    }
    </style>
</head>
<body>

<img src="../assets/images/wallpaper2.jpeg" alt="">

    <div class="form">
        <a href="cmaevenement.php" style="z-index: 999;"><img src="../assets/images/arrow1.png" alt="" class="arrow"></a>
        <h1>Suppression</h1>
        <?php echo "<p>$event</p>" ?>
    </div>
</body>
</html>