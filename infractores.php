<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Infractores</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <form action="infractores.php" method="post">
        <h1>Script infractores</h1>
        <?php
            $ficheroVehiculos = fopen("documentosTxt/vehiculos.txt", "r");
            $ficheroResi = fopen("documentosTxt/ResidentesHoteles.txt", "r");
            $ficheroLogistica = fopen("documentosTxt/logistica.txt", "r");
            $ficheroServicio = fopen("documentosTxt/servicios.txt", "r");
            $ficheroTaxis = fopen("documentosTxt/taxis.txt", "r");
            $ficheroVehiculosEmt = fopen("documentosTxt/vehiculosEMT.txt", "r");

            function buscaMatriculas($ficheroVehiculos, $ficheroDemas){
                rewind($ficheroDemas);
                while (($punteroFicheros = fgets($ficheroDemas)) !== false) {
                    $punteroFicheros = trim(substr($punteroFicheros, 0, 8));
                    if ($punteroFicheros == $ficheroVehiculos) {
                        return true;
                    }
                }
                return false;
            }

            if ($ficheroLogistica || $ficheroResi || $ficheroLogistica || $ficheroServicio || $ficheroTaxis || $ficheroVehiculosEmt) {
                while (($punteroVehiculos = fgets($ficheroVehiculos))) {
                    $interruptor = false;
                    if (strpos($punteroVehiculos, "electrico")) {
                        $interruptor = true;
                    }
                    $punteroVehiculos = trim(substr($punteroVehiculos, 0, 8));
                    if (buscaMatriculas($punteroVehiculos, $ficheroLogistica) == true) {
                        $interruptor = true;
                    } elseif (buscaMatriculas($punteroVehiculos, $ficheroResi) == true) {
                        $interruptor = true;
                    } elseif (buscaMatriculas($punteroVehiculos, $ficheroServicio) == true) {
                        $interruptor = true;
                    } elseif (buscaMatriculas($punteroVehiculos, $ficheroTaxis) == true) {
                        $interruptor = true;
                    } elseif (buscaMatriculas($punteroVehiculos, $ficheroVehiculosEmt) == true) {
                        $interruptor = true;
                    }
                    if ($interruptor == false) {
                        echo "Infractor: $punteroVehiculos";
                        echo "<br><br>";
                    }
                    
                }
                echo "<br><br>";
                echo "<a href='index.html'>volver</a>";
            } else {
                die("No se ha podido leer el fichero");
            }
        ?>
        </form>
    </div>
</body>
</html>