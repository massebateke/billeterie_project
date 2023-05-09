
<?php

session_start();

require('config.php');
require("token.php");

if ($_COOKIE["validate"]){

    //préparation de la requête
    $requete = $conn->prepare("
    DELETE FROM billet WHERE visitor_id=:num LIMIT 1
    ");

    //liaison au paramètre nommé
    $requete->bindValue(':num', $_GET['id'], PDO::PARAM_INT);

    //execution de la requete
    $executeIsOk = $requete->execute();

    if($executeIsOk){
        echo "Le visiteur a été supprimé";
    }
    else{
        echo "Echec de la suppression du contact";
    }
    if($requete){ //Si la requete a reussi

    
                //Insertion dans la table inscription
                $requete = $conn->prepare("DELETE FROM visitor WHERE id=:num LIMIT 1");
                //liaison au paramètre nommé
                $requete->bindValue(':num', $_GET['id'], PDO::PARAM_INT);
                $requete->execute();
            }
}
?>