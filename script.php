<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
    <div class="container">
        <form action="script.php" method="post">
            <?php
            $formularios = $_POST['formularios'];
            $botonHTML = $_POST['enviar'];
            $botonPHP = $_POST['enviarPHP'];
            $contador = 0;
            //-----------------------------------------------------------------
            $ficheroResi = fopen("documentosTxt/ResidentesHoteles.txt", "r");
            $ficheroLogistica = fopen("documentosTxt/logistica.txt", "r");
            $ficheroServicio = fopen("documentosTxt/servicios.txt", "r");
            $ficheroTaxis = fopen("documentosTxt/taxis.txt", "r");
            $ficheroVehiculosEmt = fopen("documentosTxt/vehiculosEMT.txt", "r");
            //-----------------------------------------------------------------
            $escirbirResi = fopen("documentosTxt/ResidentesHoteles.txt", "a");
            $escribirLogisti = fopen("documentosTxt/logistica.txt", "a");
            $escribirServicio = fopen("documentosTxt/servicios.txt", "a");
            $escribirTaxis = fopen("documentosTxt/taxis.txt", "a");
            $escribirVehicuEMT = fopen("documentosTxt/vehiculosEMT.txt", "a");
            //-----------------------------------------------------------------

            /*function tipoFormulario(&$formularioParametro){
                if($formularioParametro == "logistica"){
                    echo "<h1>Formulario para Logistica</h1>";
                }else if($formularioParametro == "residentes"){
                    echo "<h1>Formulario para Residentes</h1>";
                }else if($formularioParametro == "servicios"){
                    echo "<h1>Formulario para Servicios</h1>";
                }else if($formularioParametro == "taxis"){
                    echo "<h1>Formulario para Taxis</h1>";
                }else if($formularioParametro == "vehiculosEMT"){
                    echo "<h1>Formulario para VehiculosEMT</h1>";
                }
                return $formularioParametro;
            }*/

            function pintaValores($nombreInput){
                    echo "$nombreInput: <input type='text' name=$nombreInput>";
                    echo "<br><br>";
            }

            function pintaFechas($nombreInput){
                echo "$nombreInput: <input type='date' name=$nombreInput>";
                echo "<br><br>";
            }

            function validaVacios($variable,$nombreInput, &$contadorParam){
                    if(!empty($variable)){
                        echo "$nombreInput: <input type='text' name='$nombreInput' value='$variable'>";
                        echo "<br><br>";
                        echo "<small style='color: green'>Datos Recibidos Correctamente</small>";
                        echo "<br><br>";
                        $contadorParam++;
                    }else{
                        echo "$nombreInput: <input type='text' name='$nombreInput'><small style='color: red'>Este campo no puede estar vacio</small>";
                        echo "<br><br>";
                    }
            }

            function validaFechas($variableI, $variableF, $nombreInputI, $nombreInputF, &$stringFechaI, &$stringFechaF, &$contadorParam){
                $inicio = new DateTime($variableI);
                $fin = new DateTime($variableF);
                $stringFechaI = $inicio->format('Y/m/d');
                $stringFechaF = $fin->format('Y/m/d');
                $intervalo = $inicio->diff($fin);
                if ($intervalo->format('%R%') == "-" || $inicio->format("Y/m/d") == $fin->format("Y/m/d")) {
                    echo "$nombreInputI: <input type='date' name=$nombreInputI><br><br><small style='color: red;'>No puede estar vacio</small>";
                    echo "<br><br>";
                    echo "$nombreInputF: <input type='date' name=$nombreInputF><br><br><small style='color: red;'>No puede estar vacio</small>";
                    echo "<br><br>";
                } else {
                    echo "$nombreInputI: <input type='text' name=$nombreInputI value='" . $inicio->format('Y/m/d') . "'>";
                    echo "<br><br>";
                    echo "<small style='color: green'>Datos Recibidos Correctamente</small>";
                    echo "<br><br>";
                    $contadorParam++;
                    echo "$nombreInputF: <input type='text' name=$nombreInputF value='" . $fin->format('Y/m/d') . "'>";
                    echo "<br><br>";
                    echo "<small style='color: green'>Datos Recibidos Correctamente</small>";
                    echo "<br><br>";
                    $contadorParam++;
                }
            }

            echo "<form action='script.php' method='post'>";
                if ($formularios == 'logistica') {
                    # code...
                    echo "<h1>Formulario para Logistica</h1>";
                        if(isset($botonHTML)){
                            pintaValores('matricula');
                            pintaValores('empresa');
                            echo "<input type='hidden' name='formularios' value='logistica'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                        if(isset($botonPHP)){
                            $matricula = $_POST['matricula'];
                            $empresa = $_POST['empresa'];
                            validaVacios($matricula,'matricula', $contador);
                            validaVacios($empresa,'empresa', $contador);
                            if ($contador == 2) {
                                if ($escribirLogisti) {
                                    fwrite($escribirLogisti, "$matricula $empresa\n");
                                    fclose($escribirLogisti);
                                    fclose($ficheroLogistica);
                                    echo "<small style='color: green;'>Valores escritos con exito en el fichero</small>";
                                }
                            } else {
                                echo "<small style='color: red;'>No se ha podido escribir en el fichero</small>";
                            }
                            echo "<br><br>";
                            echo "<input type='hidden' name='formularios' value='logistica'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                } elseif ($formularios == 'taxis') {
                    # code...
                    echo "<h1>Formulario para Taxis</h1>";
                        if(isset($botonHTML)){
                            pintaValores('matricula');
                            pintaValores('usuario');
                            echo "<input type='hidden' name='formularios' value='taxis'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                        if(isset($botonPHP)){
                            $matricula = $_POST['matricula'];
                            $usuario = $_POST['usuario'];
                            validaVacios($matricula,'matricula', $contador);
                            validaVacios($usuario,'usuario', $contador);
                            if ($contador == 2) {
                                if ($escribirTaxis) {
                                    fwrite($escribirTaxis, "$matricula $usuario\n");
                                    fclose($escribirTaxis);
                                    fclose($ficheroTaxis);
                                    echo "<small style='color: green;'>Valores escritos con exito en el fichero</small>";
                                }
                            } else {
                                echo "<small style='color: red;'>No se ha podido escribir en el fichero</small>";
                            }
                            echo "<br><br>";
                            echo "<input type='hidden' name='formularios' value='taxis'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                } elseif ($formularios == 'servicios') {
                    # code...
                    echo "<h1>Formulario para Servicios</h1>";
                        if(isset($botonHTML)){
                            pintaValores('matricula');
                            pintaValores('tipoServicio');
                            echo "<input type='hidden' name='formularios' value='servicios'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                        if(isset($botonPHP)){
                            $matricula = $_POST['matricula'];
                            $tipoServicio = $_POST['tipoServicio'];
                            validaVacios($matricula,'matricula', $contador);
                            validaVacios($tipoServicio,'tipoServicio', $contador);
                            if ($contador == 2) {
                                if ($escribirServicio) {
                                    fwrite($escribirServicio, "$matricula $tipoServicio\n");
                                    fclose($escribirServicio);
                                    fclose($ficheroServicio);
                                    echo "<small style='color: green;'>Valores escritos con exito en el fichero</small>";
                                }
                            } else {
                                echo "<small style='color: red;'>No se ha podido escribir en el fichero</small>";
                            }
                            echo "<br><br>";
                            echo "<input type='hidden' name='formularios' value='servicios'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                } elseif ($formularios == 'vehiculosEMT') {
                    # code...
                    echo "<h1>Formulario para VehiculosEMT</h1>";
                        if(isset($botonHTML)){
                            pintaValores('matricula');
                            pintaValores('ubicacion');
                            echo "<input type='hidden' name='formularios' value='vehiculosEMT'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                        if(isset($botonPHP)){
                            $matricula = $_POST['matricula'];
                            $ubicacion = $_POST['ubicacion'];
                            validaVacios($matricula,'matricula', $contador);
                            validaVacios($ubicacion,'ubicacion', $contador);
                            if ($contador == 2) {
                                if ($escribirVehicuEMT) {
                                    fwrite($escribirVehicuEMT, "$matricula $ubicacion\n");
                                    fclose($escribirVehicuEMT);
                                    fclose($ficheroVehiculosEmt);
                                    echo "<small style='color: green;'>Valores escritos con exito en el fichero</small>";
                                }
                            } else {
                                echo "<small style='color: red;'>No se ha podido escribir en el fichero</small>";
                            }
                            echo "<br><br>";
                            echo "<input type='hidden' name='formularios' value='vehiculosEMT'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                } elseif ($formularios == 'residentes') {
                    # code...
                    echo "<h1>Formulario para Residentes</h1>";
                        if(isset($botonHTML)){
                            pintaValores('matricula');
                            pintaValores('direccion');
                            pintaFechas('fechaI');
                            pintaFechas('fechaF');
                            //pintaValoresFechas
                            echo "<input type='hidden' name='formularios' value='residentes'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                        if(isset($botonPHP)){
                            $matricula = $_POST['matricula'];
                            $direccion = $_POST['direccion'];
                            $fechaI = $_POST['fechaI'];
                            $fechaF = $_POST['fechaF'];
                            $stringFechaI;
                            $stringFechaF;
                            validaVacios($matricula,'matricula', $contador);
                            validaVacios($direccion,'direccion', $contador);
                            validaFechas($fechaI, $fechaF, 'fechaI', 'fechaF', $stringFechaI, $stringFechaF, $contador);
                            if ($contador == 4) {
                                if ($escirbirResi) {
                                    fwrite($escirbirResi, "$matricula $direccion, $stringFechaI, $stringFechaF\n");
                                    fclose($escirbirResi);
                                    fclose($ficheroResi);
                                    echo "<small style='color: green;'>Valores escritos con exito en el fichero</small>";
                                }
                            } else {
                                echo "<small style='color: red;'>No se ha podido escribir en el fichero</small>";
                            }
                            echo "<br><br>";
                            echo "<input type='hidden' name='formularios' value='residentes'>";
                            echo "<button><a href='index.html'>Volver</a></button>";
                            echo "<br><br>";
                            echo "<input type='submit' name='enviarPHP' value='Enviar datos en PHP'>";
                        }
                }
            echo "</form>";
            ?>
        </form>
    </div>
</body>
</html>