<?php
#FUNCIÓ PER REALITZAR LA CONNEXIÓ A LA BD
function connectarBD($db_host, $db_usuari, $db_password, $db_nom)
{
    try {
        $DB = new PDO("mysql:host=$db_host; dbname=$db_nom;charset=utf8", $db_usuari, $db_password);
        return $DB;
      } catch (PDOException $e) {
        echo "Error al conectarse a la base de dades.";
        die();
      }
    
}
#VARIABLES PER LA CONNEXIÓ A LA BASE DE DADES
$db_host = "localhost";
$db_usuari = "user";
$db_password = "aplicacions";
$db_nom = "incidencies";

$db = connectarBD($db_host, $db_usuari, $db_password, $db_nom);