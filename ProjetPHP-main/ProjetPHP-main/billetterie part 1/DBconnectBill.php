<?php
// La BDD du système d'auth
$servername = "localhost";
$username = "root";
$password = "";
$visitorquery = " select first_name from visitor ;";
$conn = new PDO("mysql:host=$servername;dbname=syst_billeterie", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

  
?> 