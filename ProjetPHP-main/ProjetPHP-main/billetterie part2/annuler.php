<?php

session_start();

require_once("../authentification/config.php");
require("token.php");


if (isset($_COOKIE["validate"]) && $_COOKIE["validate"] == true) {
    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
    if($methode == "GET")
    {

    // Récupère tous les évènements
    $conn = mysqli_connect("localhost", 'Celena', 'Celena', 'Syst_Auth');
    $sql = mysqli_query($conn , "SELECT * FROM event");
    $rows = mysqli_fetch_all($sql, MYSQLI_ASSOC);
    

        if (mysqli_num_rows($result) > 0) {
            // Affichage des données de chaque ligne
            while($row = mysqli_fetch_assoc($result)) {
                echo "Nom: " . $row["nom"]. " - Date: " . $row["date"]. " - Lieu: " . $row["lieu"]. "<br>";
            }
        }

    
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Modifier un évènement</title>
    <link rel="stylesheet" type="" href="style1.css">
  </head>
  <style>
     h1 {
      margin-top: -32px;
    }
    .form {
      transform: translateY(10%);
    }
    .form img {
      position: absolute;
      width: 40px;
      height: 40px;
    }
    button {
      margin-right: 10px;
    } 
  </style>
  <body>
    <img src="images/wallpaper2.jpeg" alt="">
    <div class="form">
      <a href="cmaevenement.php" style="z-index: 999;"><img src="images/arrow1.png" alt="" class="arrow"></a>
      <h1>Selectionner un évènement à annuler</h1>
      <?php if ($rows->rowCount() > 0) : ?>
        <p style="background: #FAA; color: red; padding: .5rem .75rem">
        <?php echo "Désolé, mais il n'y a pas d'évènement inscrit." ?>
        </p>
      <?php endif; ?>
      <ul>
        <?php foreach ($rows as $row) : ?>
          <li><?php echo $row["name"]; ?> <a href="annuler02.php?name=<?php echo $row["name"]; ?> ?lieu=<?php echo $row["lieu"]; ?> ?date=<?php echo $row["date"]; ?>">Supprimer</a> </li>
        <?php endforeach; ?>
      </ul>
    </div>
  </body>
</html>