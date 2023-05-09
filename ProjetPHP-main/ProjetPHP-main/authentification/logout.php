<?php
// logout.php : Comment se déconnecter
require('config.php');
// Etape 1 : On démarre la session
session_start();
$login = $_COOKIE["username"];
$requete = $pdo->prepare("UPDATE users SET token = :token WHERE username = :login");
$requete->execute([":token" => "", ":login" => $login]);
// Etape 2 : On supprime tout le contenu de la session
session_destroy();
// Etape 3 : On redirige la personne vers le login (par exemple)
header('Location: login.php');
// C'est fini 