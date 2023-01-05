<?php
include "Middlewares/auth.php"; #A Middlewares s'inicia sessió.
if (session_status() === PHP_SESSION_NONE) session_start();

if (isset($_POST['tancar-sessio'])) {
    session_regenerate_id();
    session_destroy();
    $_SESSION = [];
    redirigirPagina("login.php");
}

function mitjaHumitatDiaActual() {
    include 'database/connexio.php';
    $preparacio = $connexio ->prepare('SELECT AVG(mitjana_humitat) as mitjana_humitat FROM dades WHERE data = cast(Date(Now()) as Date);');
    $preparacio->execute();
    $resultats = $preparacio ->fetchall();
    if ($resultats[0]['mitjana_humitat'] == "") {
        $resultats[0]['mitjana_humitat'] = "-";
    }
    return $resultats[0]['mitjana_humitat'];
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
        <div class="m-auto d-flex justify-content-between p-3 bg-transparent-light">
            <h2>Benvingut <?php echo ($_SESSION["user"]) ?></h2>
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button type="submit" name="tancar-sessio" class="btn btn-danger ml-0">Tancar Sessió</button>
            </form>
        </div>


        <div class="container m-auto p-5 d-flex flex-column justify-content-center align-items-center">

            <div class="form-container border border-white pt-4 pb-4 pl-5 pr-5 bg-transparent-light">
                <div class="pt-2 pb-2 pl-3 pr-3">
                    <div class="d-flex flex-column">
                        <form class="w-100" method="POST" action="mostrar_dades.php">
                            <h3 class="text-center p-3">Menú d'Opcions</h3>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100" name="darrera_temp">Darrera temperatura registrada</button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100" name="darrera_hum">Darrera humitat de l’aire registrada</button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary w-100" name="tot">Totes les dades (Grafic)</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-5 form-container border border-white pt-4 pb-4 pl-5 pr-5 bg-transparent-light">
                <div class="pt-2 pb-2 pl-3 pr-3">
                    <div class="d-flex flex-column">
                        <form class="w-100" method="POST" action="mostrar_dades.php">
                            <h3 class="text-center p-3">Dades Actuals</h3>
                            <table class="table table-bordered">
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
                                        <th scope="row">+</th>
                                        <td><?php ?></td>
                                        <td rowspan="2"><?php echo mitjaHumitatDiaActual() ?></td>
                                        <td><?php ?></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">-</th>
                                        <td><?php ?></td>
                                        <td><?php ?></td>
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