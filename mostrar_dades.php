<?php
include "Middlewares/auth.php";
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</head>

<body>
    <div id="particles-js"></div>
    <div class="first-container">
        <div class="container m-auto p-5 d-flex flex-column justify-content-center align-items-center">
            <div class="m-5 form-container border border-white pt-4 pb-4 pl-5 pr-5 bg-transparent-light">
                <div class="pt-2 pb-2 pl-3 pr-3">
                <?php
                    function ultimaTemperatura() {
                        include 'database/connexio.php';
                        $preparacio = $connexio ->prepare('SELECT * FROM dades ORDER BY data DESC LIMIT 1;');
                        $preparacio->execute();
                        echo "<table>";
                        while ($resultats = $preparacio ->fetch()){
                            echo "<tr>";
                            echo "<td>Darrera temperatura registrada</td>";
                            echo "<td>" . $resultats['temperatura'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    function ultimaHumitat() {
                        include 'database/connexio.php';
                        $preparacio = $connexio ->prepare('SELECT * FROM dades ORDER BY data DESC LIMIT 1;');
                        $preparacio->execute();
                        echo "<table>";
                        while ($resultats = $preparacio ->fetch()){
                            echo "<tr>";
                            echo "<td>Darrera humitat de l’aire registrada</td>";
                            echo "<td>" . $resultats['mitjana_humitat'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    function temperaturaDiaActual() {
                        include 'database/connexio.php';
                        $preparacio = $connexio ->prepare('SELECT MAX(temperatura) as temperatura FROM dades WHERE data = cast(Date(Now()) as Date);');
                        $preparacio->execute();
                        echo "<table>";
                        while ($resultats = $preparacio ->fetch()){
                            echo "<tr>";
                            echo "<td>Temperatura més alta del dia</td>";
                            echo "<td>" . $resultats['temperatura'] . "</td>";
                            echo "</tr>";
                        $preparacio = $connexio ->prepare('SELECT MIN(temperatura) as temperatura FROM dades WHERE data = cast(Date(Now()) as Date);');
                        $preparacio->execute();
                        echo "<table>";
                        while ($resultats = $preparacio ->fetch()){
                            echo "<tr>";
                            echo "<td>Temperatura més baixa del dia</td>";
                            echo "<td>" . $resultats['temperatura'] . "</td>";
                            echo "</tr>";
                            }
                        }
                    }
                    function mitjaHumitatDiaActual() {
                        include 'database/connexio.php';
                        $preparacio = $connexio ->prepare('SELECT AVG(mitjana_humitat) as mitjana_humitat FROM dades WHERE data = cast(Date(Now()) as Date);');
                        $preparacio->execute();
                        echo "<table>";
                        while ($resultats = $preparacio ->fetch()){
                            echo "<tr>";
                            echo "<td>Mitjana Humitat del dia actual:</td>";
                            echo "<td>" . $resultats['mitjana_humitat'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    function temperaturaAltaIBaixaAny() {
                        include 'database/connexio.php';
                        $preparacio = $connexio ->prepare('SELECT MAX(temperatura) as temperatura FROM dades WHERE year(data) = year(Now());');
                        $preparacio->execute();
                        echo "<table>";
                        while ($resultats = $preparacio ->fetch()){
                            echo "<tr>";
                            echo "<td>Temperatura més alta de l'any actual:</td>";
                            echo "<td>" . $resultats['temperatura'] . "</td>";
                            echo "</tr>";
                        }
                        $preparacio = $connexio ->prepare('SELECT MIN(temperatura) as temperatura FROM dades WHERE year(data) = year(Now());');
                        $preparacio->execute();
                        echo "<table>";
                        while ($resultats = $preparacio ->fetch()){
                            echo "<tr>";
                            echo "<td>Temperatura més baixa de l'any actual:</td>";
                            echo "<td>" . $resultats['temperatura'] . "</td>";
                            echo "</tr>";
                        }
                    }
                    include 'database/connexio.php';
                    if (isset($_POST["darrera_temp"])) {
                        ultimaTemperatura();
                    }
                    elseif (isset($_POST["darrera_hum"])) {
                        ultimaHumitat();
                    }
                    elseif (isset($_POST["max_min_temp_avui"])) {
                        temperaturaDiaActual();
                    }
                    elseif (isset($_POST["mitjana_hum"])) {
                        mitjaHumitatDiaActual();
                    }
                    elseif (isset($_POST["max_min_temp_any"])) {
                        temperaturaAltaIBaixaAny();
                    }
                    elseif (isset($_POST["tot"])) {
                        header("Location: http://localhost/project-web-php/grafic.php");
                        exit;
                    }
                ?>
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