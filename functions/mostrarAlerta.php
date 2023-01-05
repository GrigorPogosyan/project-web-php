<?php #FUNCIÓ ALERTA QUE ENS SERVIRÀ PER MOSTRAR ALERTES
function mostrarAlerta($tipusAlerta, $textAlerta, $width=NULL)  #width optional parameter
{
    echo "
    <div class='alert alert-$tipusAlerta $width mt-3 fade-in-div' role='alert'>
        $textAlerta
    </div>";
}
?>