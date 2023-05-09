

<?php

session_start();

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

require_once 'vendor/autoload.php'; //changer le chemin si besoin

require('config.php');
require("token.php");

if ($_COOKIE["validate"]){

    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
    if($methode == "POST")
    {
        //$validate = $_COOKIE["validate"];

        // Récupère les données du formulaire
        $event_id = filter_input(INPUT_POST, "event");
        $first_name = filter_input(INPUT_POST, "first_name");
        $last_name = filter_input(INPUT_POST, "name");
        $email = filter_input(INPUT_POST, "email");
        $date = filter_input(INPUT_POST, "date");



        // Vérifier que les champs ne sont pas vides
        if(empty($first_name) || empty($last_name)|| empty($email) || empty($date)){
            echo "Tous les champs sont obligatoires.";
        } else {
            // Requête d'insertion de données dans la table
            $length = rand(6, 10); // longueur aléatoire entre 6 et 10 caractères
            $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // caractères autorisés
            $public_code = '';

            // générer la chaîne de caractères aléatoire
            for ($i = 0; $i < $length; $i++) {
                $random_index = rand(0, strlen($characters) - 1);
                $public_code .= $characters[$random_index];
            }

            // Stocke les données de l'événement dans la BDD
            $requete = $conn->prepare("
                INSERT INTO visitor (first_name, last_name, email) VALUES(:first_name, :last_name, :email)
            ");


            $requete->execute([
                ":first_name" => $first_name,
                ":last_name" => $last_name,
                ":email" => $email,
            ]);

            // Affiche un message de confirmation

            echo "L'événement \"$first_name\" a été créé avec succès.";

            if($requete) //Si la requete a reussi
            {
    
                //On récupère la dernière valeur de l'id stocké dans la table.
                $visitor_id = $conn->lastInsertId() ;
                $requete->closeCursor();

                $writer = new PngWriter();
                $lien = 'http:localhost/back/ValidateTicket.php?visitor_id=$visitor_id&event_id=$event_id&creation_dat=$date&public_code=$public_code';  //changer le chemin si besoin
                // Créer un objet QrCodee
                $qrCode = new QrCode($lien);

                // Définir la taille du QR code
                $qrCode->setSize(300);

                // Obtenir l'image du QR code
                $result = $writer->write($qrCode);

                // Afficher l'image du QR code
                header('Content-Type: image/png');
                echo $result->getString();
                
    
                //Insertion dans la table inscription
                $requete = $conn->prepare("INSERT INTO billet(visitor_id, event_id, creation_date, public_code, qrcode) 
                VALUES(:visitor_id, :event_id, :creation_date, :public_code, :qrcode)"); // il manque qrcode
                $requete->execute(
                    [
                        'visitor_id' => $visitor_id,
                        'event_id' => $event_id,
                        'creation_date' => $date,
                        'public_code' => $public_code,
                        'qrcode' => $qrcode
                        
                    ]
                );
    
    
    
    
            }
    
        }
    } 
} 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription_event</title>
</head>
<body>
    <h1>Inscription à un évenement</h1>
    <form method="post" action="inscription_event.php">

        <label for="Event">Id de l'évenement :</label>
        <input type="text" id="Event" name="event" required><br><br> 

        <label for="Prénom">Prénom :</label>
        <input type="text" id="Prénom" name="first_name" required><br><br>

        <label for="name">Nom :</label>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">e-mail :</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="Date">Date de création du billet :</label>
        <input type="date" min="24/04/20023" id="Date" name="date" required><br><br>

        <input type="submit" name="submit" value="Ajouter" class="box-button" />
    </form>
</body>
</html>

<?php
