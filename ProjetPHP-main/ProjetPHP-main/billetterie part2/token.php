<?php

require_once("../authentification/config.php");

$token = $_COOKIE["token"];
$username = $_COOKIE["username"];

$stmt = $pdo->prepare("SELECT token FROM users WHERE username = :username");
$stmt->execute(['username' => $username]);
$resultat = $stmt->fetchAll();
$bdd_token = $resultat['token'];

if ($token == $bdd_token) {
  setcookie("validate", true);
} else {
  setcookie("validate", false);
}