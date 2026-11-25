<?php
require_once "Socio.php";
require_once "Libro.php";
require_once "AccesoDatos.php";

$cod_socio = $_POST["cod_socio"] ?? "";
$cod_libro = $_POST["cod_libro"] ?? "";
$mensaje = "";

function accionBuscarSocio($codigo) {
    $bd = AccesoDatos::initModelo();
    return $bd->buscarSocio($codigo);
}

function accionBuscarLibro($codigo) {
    $bd = AccesoDatos::initModelo();
    return $bd->buscarLibro($codigo);
}

function accionPrestarLibro($cod_socio, $cod_libro) {
    $bd = AccesoDatos::initModelo();
    return $bd->prestarLibro($cod_socio, $cod_libro);
}

// Comprobamos el socio.
$socio = accionBuscarSocio($cod_socio);

if ($socio == false) {
    $mensaje = "ERROR: El socio no existe.";
} else {
    // Comprobamos el libro.
    $libro = accionBuscarLibro($cod_libro);

    if ($libro == false) {
        $mensaje = "ERROR: El libro no existe.";
    } else {
        if ($libro["ejemplares"] > 0) {
            if (accionPrestarLibro($cod_socio, $cod_libro)) {
                $mensaje = "Préstamo realizado correctamente.<br>";
                $mensaje .= "Socio: " . $socio["nombre"] . "<br>";
                $mensaje .= "Libro: " . $libro["titulo"] . "<br>";
                $mensaje .= "Ejemplares que quedaban: " . ($libro["ejemplares"] - 1);
            } else {
                $mensaje = "No se ha podido registrar el préstamo.";
            }
        } else {
            $mensaje = "No quedan ejemplares de ese libro.";
        }
    }
}

echo $mensaje;
?>
