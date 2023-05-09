<?php

require('../authentification/config.php');
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="" href="../assets/styles/style2.css">
    <style>
        .form .button {
            margin-bottom: -20px;
        }

        .form h1 {
             white-space: normal;
        }
    </style>
</head>
<body>
<img src="../assets/images/wallpaper.jpeg" alt="">

<div class="form">
<h1>Quelle action souhaitez-vous effectuer?</h1>
    <form method = "post" action= "cmaevenement.php">    
        <button class="button" type="button" id="Event"><a href="creer.php">Créer un événement</a></button>
        <br><br>
        <button class="button" type="button" id="Modifier"><a href="modifier.php">Modifier un évènement</a></button>
        <br><br>
        <button class="button" type="button" id="Annuler"><a href="annuler.php">Annuler un évènement</a></button>
	</form>
</div>
</body>
</html>