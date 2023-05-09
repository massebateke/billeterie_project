<?php
session_start();


require('config.php');


//preparation de la requete 
 $requete = $conn->prepare('SELECT * FROM billet WHERE event_id=:num');


//liaison au paramètre nommé
$requete->bindValue(':num', $_GET['event_id'], PDO::PARAM_INT);

 //execution de la requete 
 $executeIsOk = $requete->execute();


 //recuperation de resultat
 $billet = $requete->fetchAll();

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lisre des visiteurs</title>

 </head>
 <body>
    <h1>Liste des contacts</h1>
    <ul>
        <?php foreach ($billet as $billet): ?>
            <li>
                <?= $billet['visitor_id'] ?> <?= $billet['event_id']?> <?=$billet['creation_date']?> <?=$billet['public_code']?> <a href="desinscription_event.php?id=<?= $billet['visitor_id'] ?>">Supprimer</a>
            </li>
        <?php endforeach; ?>
    </ul>

 </body>
 </html>