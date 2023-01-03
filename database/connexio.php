<?php
$dbHost="localhost";
$dbNom="estadistiques";
$dbUsuari="user";
$dbPassword="aplicacions";
try {
   $connexio=new PDO("mysql:host=$dbHost;dbname=$dbNom", $dbUsuari, $dbPassword);
   $connexio->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
   echo "Connection failed: " . $e->getMessage();
}
?>