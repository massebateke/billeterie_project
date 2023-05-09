<?php

session_start();

// require_once 'config.php';
require("token.php");
require("../authentification/config.php");

// $rows = null;
// $resultat = null; 
// if (isset($_COOKIE["validate"]) && $_COOKIE["validate"] == true) {

//   // Récupère tous les évènements
//   $stmt = $pdo->query('SELECT * FROM event');
//   global $rows;
//   $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

//   if (count($rows) == 0) {
//     global $resultat;
//     $resultat = "Désolé, mais il n'y a pas d'évènement inscrit.";
//   }

// }

if (isset($_COOKIE["validate"]) && $_COOKIE["validate"] == true) {

    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
    if($methode == "GET")
    {

    // Récupère tous les évènements
    $conn = mysqli_connect("localhost", 'Yohann', 'Yohann', 'Syst_Auth');
    $sql = mysqli_query($conn , "SELECT * FROM event");
    $rows = mysqli_fetch_all($sql, MYSQLI_ASSOC);
    

        if (mysqli_num_rows($result) > 0) {
            // Affichage des données de chaque ligne
            while($row = mysqli_fetch_assoc($result)) {
                echo "Nom: " . $row["nom"]. " - Date: " . $row["date"]. " - Lieu: " . $row["lieu"]. "<br>";
            }
        } else {
          $resultat = "Désolé, mais il n'y a pas d'évènement inscrit.";
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
    <title>Modifier un évènement</title>
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
    <h1>Sélectionnez l'évènement à modifier</h1>
    <?php if ($resultat !== null) : ?>
    <p style="background: #FAA; color: red; padding: .5rem .75rem"><?= $resultat ?></p>
    <?php endif; ?>

    <ul>
    <?php foreach ($rows as $row) : ?>
        <li>
          <a href="modif02.php?name=<?php echo $row["name"]; ?>">
            <?php echo $row["name"]; ?>
          </a> 
      </li>
    <?php endforeach; ?>
    </ul>
  </div>
</body>
</html>