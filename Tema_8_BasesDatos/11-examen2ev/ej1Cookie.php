
<?php
/*
EJERCICIO 1:
Realiza una página PHP que cuente las veces que un usuario
visita la página utilizando una cookie llamada "visitas".

- Si no existe, se inicializa a 1.
- Si existe, se incrementa en una unidad.
- La cookie dura un día.
- Se muestra el número de visitas.
- Mediante un botón "Reiniciar" se pone el contador a cero.
*/

// COMPROBAMOS SI EXISTE LA COOKIE
if (isset($_COOKIE["visitas"])) {
    $visitas = $_COOKIE["visitas"] + 1;
} else {
    $visitas = 1;
}

// GUARDAMOS LA COOKIE DURANTE UN DIA
setcookie("visitas", $visitas, time() + 86400);

// COMPROBAMOS SI SE HA PULSADO REINICIAR
if (isset($_GET["accion"]) && $_GET["accion"] == "Reiniciar") {
    $visitas = 0;
    setcookie("visitas", 0, time() + 86400);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contador de visitas</title>
</head>
<body>

    <h2>Contador de visitas</h2>

    <?php
    echo "Has visitado esta página " . $visitas . " veces";
    ?>

    <form method="GET" action="contadorcookies.php">
        <input type="submit" name="accion" value="Reiniciar">
    </form>

</body>
</html>
