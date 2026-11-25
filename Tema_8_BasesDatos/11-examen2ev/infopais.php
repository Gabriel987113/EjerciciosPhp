<?php
/*
$paises["Argentina"]["Capital"][0]; // Buenos Aires
Para acceder a Buenos Aires: $paises["Argentina"]["Capital"];
Para acceder a la población:$paises["Argentina"]["Poblacion"];
*/
//$paises["España"]["Capital"] contiene "Madrid".
//$paises["España"]["Capital"][0]; // Madrid))
$paises = array(
    'Argentina' =>     array("Capital" => "Buenos Aires",     "Poblacion" => "40000000"),
    'Francia' =>     array("Capital" => "París",         "Poblacion" => "50000000"),
    'España' =>     array("Capital" => "Madrid",     "Poblacion" => "42000000"),
    'Italia' =>     array("Capital" => "Roma",         "Poblacion" => "46000000"),
    'Suiza' =>         array("Capital" => "Zúrich",     "Poblacion" =>  "9000000"),
    'Colombia' =>     array("Capital" => "Bogotá",     "Poblacion" => "36000000"),
    'Chile' =>     array("Capital" => "Santiago",     "Poblacion" => "36000000"),
    'Suecia' =>     array("Capital" => "Estocolmo",     "Poblacion" => "25000000"),
);

/*
Para acceder a Burdeos sería:$ciudades["Francia"][1];
*/
$ciudades = [
    'Argentina' =>  ["Buenos Aires", "Córdoba", "Parana", "Rosario"],
    'Francia' =>    ["París", "Burdeos", "Niza", "Lille", "Nantes"],
    'España' =>     ["Madrid", "Barcelona", "León", "Sevilla", "Valencia", "Málaga"],
    'Italia' =>     ["Roma", "Venecia", "Florencia", "Pisa", "Génova", "Milán", "Turín", "Nápoles"],
    'Suiza'  =>     ["Zúrich", "Ginebra", "Basilea", "Lausana"],
    'Colombia' =>   ["Bogotá", "Medellín", "Cali", "Barranquilla", "Bucaramanga"],
    'Chile' =>      ["Santiago", "Arica", "Iquique", "Osorno", "Viña del Mar"],
    'Suecia' =>   ["Estocolmo", "Upsala", "Gotemburgo", "Lund"],
];

$mensajeError = "";
$mostrarPaises = "";
$msg = "";
$poblaciones = [];

//COMPROBAMOS QUE SE HA INTRODUCIDO UN PAIS
if (isset($_GET["pais"])) {
    // Comprobamos si el país introducido por el usuario existe como clave en el array $paises.
    if (isset($paises[$_GET["pais"]])) {
        //mostrar todas las ciudades del país menos su capital, $ciudades[$_GET["pais"]] accede únicamente a las ciudades de ese país.
        $mostrarPaises = "Ciudades: ";
        foreach ($ciudades[$_GET["pais"]] as $ciudad) {
            if ($ciudad != $paises[$_GET["pais"]]["Capital"]) {
                $mostrarPaises .=  $ciudad . ", ";
            }
        }

        //Estamos creando otro array que solamente guardará el nombre del país y su población.
        //$pais contiene la clave: Argentina, Francia, España...
        //$datos contiene el array interno de ese país, es decir, su capital y su población.
        //$poblaciones[$pais] añade el país como clave al array $poblaciones.
        //$datos["Poblacion"] obtiene la población de ese país como valor.
        //si quisiéramos guardar las capitales en lugar de las poblaciones, seria:$poblaciones[$pais] = $datos["Capital"];
        foreach ($paises as $pais => $datos) {
            $poblaciones[$pais] = $datos["Poblacion"];
        }

        //LO ORDENAMOS DE MENOR A MAYOR
        asort($poblaciones);

        // de mayor a menor arsort($poblaciones);
         //ksort() → ordena por claves de menor a mayor.
        // Construimos la tabla.
        $msg .= "<table border='1'>";
        $msg .= "<tr><th>País</th><th>Población</th></tr>";

        //$pais recoge la clave (Argentina, Francia, España...).
        //$poblacion recoge el valor asociado a esa clave (40000000, 50000000...).
        foreach ($poblaciones as $pais => $poblacion) {
            $msg .= "<tr><td>" . $pais . "</td>";
            $msg .= "<td>" . $poblacion . "</td></tr>";
        }

        $msg .= "</table>";
    } else {
        $mensajeError = "El pais " . $_GET["pais"] .  " no existe";
    }
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form method="GET" action="infopais.php">
        <label>Introduce un pais:</label>
        <input type="text" name="pais">

        <input type="submit" value="Consultar">

    </form>

    <?php
    echo $mensajeError;
    echo $mostrarPaises;
    echo $msg;

    ?>
</body>

</html>