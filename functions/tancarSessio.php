<?php 
function tancarSessio(){
    session_regenerate_id();
    session_destroy();
    $_SESSION = [];
    redirigirPagina("login.php");
}
?>