<?php
include "Middlewares/auth.php"; #A Middlewares s'inicia sessió.
include "functions/mostrarAlerta.php";
if (session_status() === PHP_SESSION_NONE) session_start();

function mitjaHumitatDiaActual()
{
    include 'database/connexio.php';
    $preparacio = $connexio->prepare('SELECT AVG(mitjana_humitat) as mitjana_humitat FROM dades WHERE data = cast(Date(Now()) as Date);');
    $preparacio->execute();
    $resultats = $preparacio->fetchall();
    if (isset($resultats[0]['mitjana_humitat'])){
        return round($resultats[0]['mitjana_humitat'],2)."%";
    }
    else{
        return "-";
    }
}

function temperaturaAltaIBaixaAny()
{
    include 'database/connexio.php';
    $preparacio = $connexio->prepare('SELECT MAX(temperatura) as temperatura FROM dades WHERE year(data) = year(Now());');
    $preparacio->execute();
    $resultats = $preparacio->fetchall();

    if (isset($resultats[0]['temperatura'])){
        $mesalta = $resultats[0]['temperatura'];
    }
    else{
        $mesalta = "-";
    }
    
    $preparacio = $connexio->prepare('SELECT MIN(temperatura) as temperatura FROM dades WHERE year(data) = year(Now());');
    $preparacio->execute();
    $resultats = $preparacio->fetchall();

    if (isset($resultats[0]['temperatura'])){
        $mesbaixa = $resultats[0]['temperatura'];
    }
    else{
        $mesbaixa = "-";
    }

    $array = array($mesalta, $mesbaixa);
    return $array;
}

function temperaturaDiaActual()
{
    include 'database/connexio.php';
    $preparacio = $connexio->prepare('SELECT MAX(temperatura) as temperatura FROM dades WHERE data = cast(Date(Now()) as Date);');
    $preparacio->execute();
    $resultats = $preparacio->fetchall();
    
    if (isset($resultats[0]['temperatura'])){
        $mesalta = $resultats[0]['temperatura'];
    }
    else{
        $mesalta = "-";
    }
    

    $preparacio = $connexio->prepare('SELECT MIN(temperatura) as temperatura FROM dades WHERE data = cast(Date(Now()) as Date);');
    $preparacio->execute();

    $preparacio->execute();
    $resultats = $preparacio->fetchall();

    if (isset($resultats[0]['temperatura'])){
        $mesbaixa = $resultats[0]['temperatura'];
    }
    else{
        $mesbaixa = "-";
    }

    $array = array($mesalta, $mesbaixa);
    return $array;
}

function ultimaTemperatura()
{
    include 'database/connexio.php';
    $preparacio = $connexio->prepare('SELECT * FROM dades ORDER BY data DESC LIMIT 1;');
    $preparacio->execute();
    if ($preparacio->rowCount() > 0) {
        $resultats = $preparacio->fetchall();
        return $resultats[0]['temperatura'];
    }
    return NULL;
}
function ultimaHumitat()
{
    include 'database/connexio.php';
    $preparacio = $connexio->prepare('SELECT * FROM dades ORDER BY data DESC LIMIT 1;');
    $preparacio->execute();
    if ($preparacio->rowCount() > 0) {
        $resultats = $preparacio->fetchall();
        return $resultats[0]['mitjana_humitat'];
    }
    return NULL;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Dades</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<body>
    <div id="particles-js"></div>
    <div class="index-page-container">
        <?php include "Components/nav-welcome.php"; ?>
        <div class="container m-auto p-5 d-flex flex-column justify-content-center align-items-center">

            <div class="form-container border border-white pt-4 pb-4 pl-5 pr-5 bg-transparent-light">
                <div class="pt-2 pb-2 pl-3 pr-3">
                    <div class="d-flex flex-column">
                        <form class="w-100" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <h3 class="text-center p-3">Menú d'Opcions</h3>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100" name="darrera_temp">Darrera temperatura registrada</button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100" name="darrera_hum">Darrera humitat de l’aire registrada</button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100" name="tot">Mitjana Mensual (Gràfic)</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <?php
            include 'database/connexio.php';
            $existeixDada = false;
            if (isset($_POST["darrera_temp"])) {
                $ultimaTemperatura = ultimaTemperatura();
                if ($ultimaTemperatura == "") {
                    $existeixDada = true;
                } else {
                    mostrarAlerta("success", "Última Temperatura: $ultimaTemperatura" . "°C");
                }
            } elseif (isset($_POST["darrera_hum"])) {
                $ultimaHumitat = ultimaHumitat();
                if ($ultimaHumitat == "") {
                    $existeixDada = true;
                } else {
                    mostrarAlerta("success", "Última Humitat: $ultimaHumitat" . "%");
                }
            } elseif (isset($_POST["tot"])) {
                redirigirPagina("grafic.php");
            }
            if ($existeixDada == true) {
                mostrarAlerta("warning", "No hi ha dades disponibles");
            }
            ?>
            <div class="mt-4 form-container border border-white p-4 bg-transparent-light">
                <div class="pt-2 pb-2 pl-3 pr-3">
                    <div class="d-flex flex-column">
                        <form class="w-100 border-round-5" method="POST" action="mostrar_dades.php">
                            <h3 class="text-center p-3">Dades Actuals</h3>
                            <table class="table table-bordered text-center table-blue border-rounded">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Temperatura més alta i més baixa registrada al dia actual</th>
                                        <th scope="col">La Humitat relativa mitjana del dia actual</th>
                                        <th scope="col">Temperatura més alta i més baixa registrada a l’any actual</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">Max</th>
                                        <td><?php echo (TemperaturaDiaActual())[0]; ?></td>
                                        <td rowspan="2" class="text-mitjana-humitat"><?php echo mitjaHumitatDiaActual()?></td>
                                        <td><?php echo (TemperaturaAltaIBaixaAny())[0]; ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Min</th>
                                        <td><?php echo (TemperaturaDiaActual())[1]; ?></td>
                                        <td><?php echo (TemperaturaAltaIBaixaAny())[1]; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        /*PER SI DESPRÉS DE ENVIAR EL FORMULARI, REFRESQUEN LA PÀGINA, QUE NO ES TORNI A ENVIAR EL MATEIX FORMULARI, PER NO FER SPAM*/
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
    <script src="js/particles.js"></script>
    <script src="js/particulas.js"></script>
</body>

</html>