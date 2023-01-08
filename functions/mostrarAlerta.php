<?php #FUNCIÓ ALERTA QUE ENS SERVIRÀ PER MOSTRAR ALERTES
function mostrarAlerta($tipusAlerta, $textAlerta, $width=NULL, $marginTop = "mt-3")  #width optional parameter
{
    echo "
    <div class='alert alert-$tipusAlerta $width $marginTop fade-in-div' role='alert'>
        $textAlerta
    </div>";
}
?>