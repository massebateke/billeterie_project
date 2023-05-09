<?php
session_start();

require('config.php');

$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
if($methode == "POST")
{
    $username = filter_input(INPUT_POST, "username");
    $email = filter_input(INPUT_POST, "email");
    $password = filter_input(INPUT_POST, "password");

    $requete = $pdo->prepare("
        INSERT INTO users (username, email, password) VALUES(:username, :email, :password)
    ");
    $requete->execute([
        ":username" => $username,
        ":email" => $email,
        ":password" => password_hash($password, PASSWORD_DEFAULT)
    ]);

    header("Location: login.php");
    exit();
} 
// else if ($methode == "GET")
// {
//   $username = filter_input(INPUT_POST, 'usernameBilleterie');
//   $email = filter_input(INPUT_POST, 'emailBilleterie');
//   $password = filter_input(INPUT_POST, 'passwordBilleterie');

//   // Requête SELECT pour vérifier si l'utilisateur et le mot de passe existent dans la table "users"
//   $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND email = :email AND password = :password");
//   $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);

//   if ($stmt->rowCount() > 0) {
//     // L'utilisateur et le mot de passe existent dans la base de données
//     echo "L'utilisateur et le mot de passe sont valides.";

//     $data = array(
//       'identifiant' => $username,
//       'motdepasse' => $password,
//     );

//     // Convertir le tableau en JSON
//     $json = json_encode($data);

//     // Définir les en-têtes HTTP pour retourner une réponse JSON
//     header('Content-Type: application/json');
//     header('Content-Length: ' . strlen($json));

//     // Envoyer la réponse JSON
//     echo $json;
//     exit();
    
//   } else if ($stmt->rowCount() == 0) {    
//     // L'utilisateur et/ou le mot de passe n'existent pas dans la base de données, on en crée un
//     $requete = $pdo->prepare("
//         INSERT INTO users (username, email, password) VALUES(:username, :email, :password)
//     ");
//     $requete->execute([
//         ":username" => $username,
//         ":email" => $email,
//         ":password" => password_hash($password, PASSWORD_DEFAULT)
//     ]);

//     // Créer un tableau associatif
//     $data = array(
//         'status' => 'Succes',
//         'message' => '',
//     );

//     // Convertir le tableau en JSON
//     $json = json_encode($data);

//     // Définir les en-têtes HTTP pour retourner une réponse JSON
//     header('Content-Type: application/json');
//     header('Content-Length: ' . strlen($json));

//     // Envoyer la réponse JSON
//     echo $json;
//     exit();
//   }
// }
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style1.css" />
</head>
<body>
<img src="images/wallpaper.jpeg" alt="">
<div class="form">
  <form class="box" action="" method="POST">
    <h1 class="box-title">S'inscrire</h1>
    <input type="text" class="box-input" name="username" placeholder="Nom d'utilisateur" required />
    <input type="text" class="box-input" name="email" placeholder="Email" required />
    <input type="password" class="box-input" name="password" placeholder="Mot de passe" required />
    <input type="submit" name="submit" value="S'inscrire" class="button" />
    <p class="box-register">Déjà inscrit? <a href="login.php">Connectez-vous ici.</a></p>
  </form>
</div>
</body>
</html> 