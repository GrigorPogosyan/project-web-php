<!DOCTYPE html>
<html lang="es">
<?php
function mostrarTot() {
        $dades = [];
        $temperatura = [];
        $humitat = [];
        $mesos = [];
    include 'database/connexio.php';
    $preparacio = $connexio ->prepare('SELECT AVG(temperatura) as temperatura,AVG(mitjana_humitat) as humitat, monthname(data) as mes FROM dades GROUP BY month(data) ORDER BY data;');
    $preparacio->execute();
    while ($resultats = $preparacio ->fetch()){
        array_push($temperatura, $resultats['temperatura']);
        array_push($humitat, $resultats['humitat']);
        array_push($mesos, $resultats['mes']);
    }
    array_push($dades, $temperatura);
    array_push($dades, $humitat);
    array_push($dades, $mesos);
    return $dades;
}
$dades = mostrarTot();
// Valores con PHP. Estos podrían venir de una base de datos o de cualquier lugar del servidor
$temperatura = $dades[0];
$humitat = $dades[1];
$mesos = $dades[2];
?>

<head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>
</head>

<body>
    <canvas id="grafica"></canvas>
    <script type="text/javascript">
        // Obtener una referencia al elemento canvas del DOM
        const $grafica = document.querySelector("#grafica");
        // Pasaamos las etiquetas desde PHP
        const mesos = <?php echo json_encode($mesos) ?>;
        // Podemos tener varios conjuntos de datos. Comencemos con uno
        const humitat = {
            label: "Humitat",
            // Pasar los datos igualmente desde PHP
            data: <?php echo json_encode($humitat) ?>,
            backgroundColor: 'rgba(54, 162, 235, 0.2)', // Color de fondo
            borderColor: 'rgba(54, 162, 235, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        const temperatura = {
            label: "Temperatura",
            // Pasar los datos igualmente desde PHP
            data: <?php echo json_encode($temperatura) ?>,
            backgroundColor: 'rgba(154, 62, 135, 0.2)', // Color de fondo
            borderColor: 'rgba(154, 62, 135, 1)', // Color del borde
            borderWidth: 1, // Ancho del borde
        };
        new Chart($grafica, {
            type: 'line', // Tipo de gráfica
            data: {
                labels: mesos,
                datasets: [
                    humitat,
                    temperatura
                    // Aquí más datos...
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }],
                },
            }
        });
    </script>
</body>

</html>