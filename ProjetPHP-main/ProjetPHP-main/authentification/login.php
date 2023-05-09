<?php
session_start();

require('config.php');

$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");
$error = null;

if ($methode == "POST") {
  $login = filter_input(INPUT_POST, "login");
  $password = filter_input(INPUT_POST, "password");
  setcookie("username", $login);

  $requete = $pdo->prepare("SELECT * FROM users WHERE username = :login");
  $requete->execute([":login" => $login]);

  $user = $requete->fetch(PDO::FETCH_ASSOC);

  if (password_verify($password, $user["password"])) {

    $_SESSION["loggedin"] = true;
    $error = null;
    
    $token = uniqid('', true);
    setcookie("token", $token);

    $requete1 = $pdo->prepare("UPDATE users SET token = :token WHERE username = :login");
    $requete1->execute([":token" => $token, ":login" => $login]);
    
    header('Location: dashboard.php');
    exit();
  } else {
    $error = "Identifiants invalides";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page de connexion</title>
    <link rel="stylesheet" type="text/css" href="../assets/styles/style1.css">
</head>
<body>

<img src="../assets/images/wallpaper.jpeg" alt="">
<div class="form">
  <h1>Connexion</h1>

  <?php if ($error !== null) : ?>
    <p style="background: #FAA; color: red; padding: .5rem .75rem">
        <?= $error ?>
    </p>
  <?php endif; ?>

  <form method="POST">
      <input class="username" placeholder="Nom d'utilisateur" type="text" name="login" id="login"><br><br>
      <input class="password" placeholder="Mot de passe" type="password" name="password" id="password"><br><br>
      <input class="button" type="submit" value="Login">

      <p class="box-register">Pas encore inscrit? <a href="register.php">Inscrivez-vous ici.</a></p>
  </form>
</div>
</body>
</html>