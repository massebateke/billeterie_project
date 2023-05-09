<?php
session_start();
require "DBconnectBill.php";
$username = $_POST["name"];
$ticketnum = $_POST["ticketnum"];
$passed   = FALSE;

$stmt = $conn->prepare($visitorquery);
$stmt->execute();
$r = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$result = $stmt->fetchAll();
foreach ($result as $row) 
{
    if ($ticketnum === $row["visitor_id"] && $username === $row["visitor_id"]) {
        $passed   = TRUE;
        header("location: ShowTicket.php");
        
    }
}
if ($passed === FALSE) { // redirige vers la page de connexion si le nom n'est pas dans la BDD
    $passed   = TRUE;
    header("location: Access.php");
}