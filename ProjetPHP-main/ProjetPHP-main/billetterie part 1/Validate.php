<?php
session_start();
require("DBconnectAuth.php");
$username = $_POST["username"];
$password = $_POST["password"];
$passed   = FALSE;
$stmt = $conn->prepare($usersquery);
$stmt->execute();
$r = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();
foreach ($result as $row) 
{
    if (password_verify($password, $row["password"]) && $username === $row["username"] || $username === $row["email"] ) {
        $passed = TRUE;
        $_SESSION["logintoken"] ="loggedin";
        setcookie("username",$username);
        header("location: index.php");
    }}
if ($passed === FALSE) { // redirige vers la page de connexion si le nom n'est pas dans la BDD
    header("location: Connect.php");

}
