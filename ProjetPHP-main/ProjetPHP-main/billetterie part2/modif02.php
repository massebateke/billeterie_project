<?php

session_start();

require("../authentification/config.php");
require("token.php");

$evenement = null;

if (isset($_COOKIE["validate"]) && $_COOKIE["validate"] == true) {
  $name = filter_input(INPUT_GET, "name");
  $requete_name = $pdo ->prepare("SELECT * FROM event WHERE name = :name");
  $requete_name ->bindValue($_GET['name'], PDO::PARAM_STR_CHAR);
      $requete_name -> execute([
          ":name" =>$name
      ]);
      global $evenement;
      $evenement = $requete_name->fetch(PDO::FETCH_ASSOC);


  $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
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

          // Met à jour les données de l'événement dans la BDD

          $requete = $pdo->prepare("
                  
              UPDATE event SET name = ':name', date = ':date', lieu = ':lieu' WHERE name=':num' LIMIT 1
          ");
          
          $requete_name ->bindValue(':num',$_GET['name'], PDO::PARAM_STR_CHAR);

          $requete->execute([
              ":name" => $name,
              ":date" => $date,
              ":lieu" => $lieu,
          ]);

          // Affiche un message de confirmation
          
          echo "L'évènement \"$name\" a été modifié avec succès.";
      }
  } 
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Connexion</title>
  <link rel="stylesheet" type="" href="../assets/styles/style1.css">
  <style>

    h1 {
      margin-top: -32px;
    }
    button {
      margin-right: 10px;
    } 

    .form img {
      position: absolute;
      width: 40px;
      height: 40px;
    }
    .form form input {
      margin-bottom: 0px;
    }
  </style>
</head>
<body>
  <img src="../assets/images/wallpaper2.jpeg" alt="">
  <div class="form">
    <a href="modifier.php" style="z-index: 999;"><img src="../assets/images/arrow1.png" alt="" class="arrow"></a>
    <h1>Modifier l'évènement</h1>
    <form method="GET" action="modifier.php">
      <input placeholder="Nom" type="text" name="name" value= "<?php echo $evenement ['name']; ?>"><br><br>
      <input placeholder="Date" type="text" name="date" value= "<?php echo $evenement01 ['date']; ?>"><br><br>
      <input placeholder="Lieu" type="text" name="lieu" value= "<?php echo $evenement02 ['lieu']; ?>" ><br><br>
      <input class="submit" type="submit" name="submit" value="Modifier" class="box-button" />
    </form>
  </div>
</body>
</html>