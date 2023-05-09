<?php
// Mettez vos informations d'identification ici
$host = 'localhost';
$port = '8889';
$dbname = 'Syst_Auth';
$bddUser = 'Yohann';
$bddPassword = 'Yohann';

$dsn = "mysql:host=$host:$port;dbname=$dbname;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $bddUser, $bddPassword, [PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION]);
} catch (PDOException $e) {
    echo 'Erreur de connexion : ' . $e->getMessage();
}

?>