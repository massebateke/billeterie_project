<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    .Loggedin {
        display:<?=$logged;?>
    }
    .loggingin {
        display:<?=$loggingin;?>
    }

</style>
<body>
    <a href="Connect.php" class="loggingin">Se connecter</a>
    <div class="Loggedin" >
        <?=$username?>
        <?=$password?> <!-- montre les infos de l'utilisateur --> 
    </div>
    <div class="Loggedin">
        <a href="Disconnect.php">Disconnect From current Session</a> <!-- lien pour se deco -->
    </div>
    <div class="Loggedin" >
        <a href="Access.php" >Show ticket</a>
    </div>
</body>
</html>