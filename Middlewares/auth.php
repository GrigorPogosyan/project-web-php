<?php 
include "functions/redirigirPagina.php";
if (session_status() === PHP_SESSION_NONE) session_start();

if (isset($_SESSION['user']) &&  $_SESSION['status-login'] = "correct"){
    #Si no fem exclusions i estem a index.php i accedim als botons no ens deixarà
    $exclusions = ["grafic.php","mostrar_dades.php"];
    if (getLastSlug() != "index.php" && (!in_array(getLastSlug(),$exclusions))){
        redirigirPagina("index.php");
    }
}
else{
    if (getLastSlug() != "login.php"){
        redirigirPagina("login.php");
    }
    
}

function getLastSlug()
{
    $url = $_SERVER['REQUEST_URI'];
    $url = explode('/', $url);
    return $url[count($url) - 1];
}