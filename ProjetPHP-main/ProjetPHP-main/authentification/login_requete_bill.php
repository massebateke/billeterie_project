<?php 

require_once('config.php');

$methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

if ($methode == "POST")
{
  $login = filter_input(INPUT_POST, "loginBilleterie");
  $password = filter_input(INPUT_POST, "passwordBilleterie");

  $requete = $pdo->prepare("SELECT * FROM users WHERE username = :login");
  $requete->execute([":login" => $login]);

  $utilisateur = $requete->fetch(PDO::FETCH_ASSOC);

  if (password_verify($password, $utilisateur["password"])) {

    $data = array(
      'status' => 'Success',
      'message' => '',
    );

    // Convertir le tableau en JSON
    $json = json_encode($data);

    // Définir les en-têtes HTTP pour retourner une réponse JSON
    header('Content-Type: application/json');
    header('Content-Length: ' . strlen($json));

    // Envoyer la réponse JSON
    echo $json;

    $token = uniqid('', true);
    setcookie("token", $token);

    $requete1 = $pdo->prepare("UPDATE users SET token = :token WHERE username = :login");
    $requete1->execute([":token" => $token, ":login" => $login]);

    exit(); // Coupe PHP

  } else {
    $data = array(
      'status' => 'Error',
      'message' => 'Identifiant incorrects'
    );

    // Convertir le tableau en JSON
    $json = json_encode($data);

    // Définir les en-têtes HTTP pour retourner une réponse JSON
    header('Content-Type: application/json');
    header('Content-Length: ' . strlen($json));

    // Envoyer la réponse JSON
    echo $json;
    exit();
  }
}
?>