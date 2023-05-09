<?php 
$servername = "localhost";
$username = "root";
$password = "";
$usersquery = "select username, password, email FROM users ";
$conn = new PDO("mysql:host=$servername;dbname=syst_auth", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);