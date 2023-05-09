<?php
    require '../vendor/autoload.php';
    use GuzzleHttp\Client;
    session_start();
    // if (!isset($_COOKIE["username"]) && !isset($_COOKIE["password"])) {
    //     $username = "";
    //     $password = "";
    // } 
    // else if (isset($_COOKIE["username"]) && isset($_COOKIE["password"])) {
    //     $username = $_COOKIE["username"];
    //     $password = $_COOKIE["password"];
    // } 

    $error = null;

    $methode = filter_input(INPUT_SERVER, "REQUEST_METHOD");

    if ($methode == "POST") {

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://localhost:8888',
        ]);
        $login = filter_input(INPUT_POST, "username");
        $password = filter_input(INPUT_POST, "password");

        $response = $client->request('POST', '/ProjetPHP/login_requete_bill.php', [
            'form_params' => [
                'loginBilleterie' => $login,
                'passwordBilleterie' => $password
            ]
        ]);

        $jsonReponse = json_decode($response->getBody());
        
        if ($jsonReponse->status == "Success") {
            $_SESSION["loggedin"] = true;
            header("Location: ../billeterie part2/creer.php");
            global $error;
            $error = null;
        } else if ($jsonReponse->status == "Error") {
            global $error;
            $error = "Identifiants invalides";
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="" href="../assets/styles/style1.css">
</head>
<body> 
  <img src="../assets/images/wallpaper2.jpeg" alt="">

    <div class="form" id = "login">
        <h1>Connexion Billetterie</h1>
        <?php if ($error !== null) : ?>
            <p style="background: #FAA; color: red; padding: .5rem .75rem">
                <?= $error ?>
            </p>
        <?php endif; ?>
        <form action = "" method = "POST"> <!-- formulaire qui connecte la personne -->
            <input placeholder="Nom d'utilisateur" type = "text" name = "username" required >
            <input placeholder="Mot de passe" type = "password" name = "password" required >
            <input class="button" type = "submit" name = "submit" value = "Enter">
        </form>
    </div>
</body>
</html>
<?php 