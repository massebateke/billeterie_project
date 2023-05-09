<?php
session_start();

require('config.php');

//preparation de la requete 
 $requete = $conn->prepare('SELECT * FROM event');

 //execution de la requete 
 $executeIsOk = $requete->execute();

 //recuperation de resultat
 $event = $requete->fetchAll();

 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

 </head>
 <body>
    <h1>Event</h1>
    <ul>
        <?php foreach ($event as $event): ?>
            <li>
                <?= $event['id'] ?> <?= $event['name']?> <?=$event['date']?> <?=$event['lieu']?> <a href="liste_visitor.php?event_id=<?= $event['id'] ?>">voir les visiteurs</a>
            </li>
        <?php endforeach; ?>
    </ul>

 </body>
 </html>