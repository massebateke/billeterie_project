<?php

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

require_once 'vendor/autoload.php';

$writer = new PngWriter();

// Créer un objet QrCode
$qrCode = new QrCode('https://www.exemple.com');

// Définir la taille du QR code
$qrCode->setSize(300);

// Obtenir l'image du QR code
$result = $writer->write($qrCode);

// Afficher l'image du QR code
header('Content-Type: image/png');
echo $result->getString();