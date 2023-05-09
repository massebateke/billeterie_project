<?php

session_start();

require("../authentification/config.php");
require("token.php");

$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

if (isset($_COOKIE["validate"]) && $_COOKIE["validate"] == true) {
  if($methode == "POST")
  {
      // Récupère les données du formulaire
      $name = filter_input(INPUT_POST, "name");
      $date = filter_input(INPUT_POST, "date");
      $lieu = filter_input(INPUT_POST, "lieu");

      // Vérifier que les champs ne sont pas vides
    if(empty($name) || empty($date) || empty($lieu)){
      echo "Tous les champs sont obligatoires.";
    } else {

      // Stocke les données de l'événement dans la BDD

          $requete = $pdo->prepare("
              INSERT INTO event (name, date, lieu) VALUES(:name, :date, :lieu)
          ");
    

          $requete->execute([
              ":name" => $name,
              ":date" => $date,
              ":lieu" => $lieu,
          ]);

          // Affiche un message de confirmation
    
          echo "L'événement \"$name\" a été créé avec succès.";
    }
  } 
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Connexion</title>
    <link rel="stylesheet" type="" href="../assets/styles/style1.css">
  </head>
  <style>
     h1 {
      margin-top: -32px;
    }
    
    .form img {
      position: absolute;
      width: 40px;
      height: 40px;
    }
    .form {
      transform: translateY(10%);
    }
    button {
  margin-right: 10px;
} 
  </style>
  <body>
    <img src="../assets/images/wallpaper2.jpeg" alt="">

    <div class="form">
      <a href="cmaevenement.php" style="z-index: 999;"><img src="../assets/images/arrow1.png" alt="" class="arrow"></a>
      <h1>Créer un évènement</h1>
      <form method="POST" action="">
        <input placeholder="Nom" type="text" id="name" name="name" required><br><br>
        <input placeholder="Date" type="date" min="2023/04/26" id="Date" name="date" required><br><br>
        <input placeholder="Lieu" type="text" id="lieu" name="lieu" required><br><br>
        <input class="submit" type="submit" name="submit" value="Créer" class="box-button" />
      </form>
    </div>
  </body>
</html>