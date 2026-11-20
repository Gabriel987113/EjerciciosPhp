<?php
session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';

$destino = $_GET['destino'];
$plazas = $_GET['plazas'];

$ac = AccesoDatos::initModelo();


// COMPROBAR QUE EL NUMERO DE PLAZAS ESTA ENTRE 1 Y 5

if (is_numeric($plazas)) {

    if (filter_var($plazas, FILTER_VALIDATE_INT) === false || $plazas < 1 || $plazas > 5) {

        $mensajeError = "El Nº de plazas no es correcto, debe estar entre 1 y 5";
        include_once "vistas/error.php";
        exit();
    }

} else {

    $mensajeError = "Debes introducir un numero en las plazas";
    include_once "vistas/error.php";
    exit();
}


// CONTAR LAS BUSQUEDAS CON UNA COOKIE

if (!isset($_COOKIE["busquedas"])) {

    $busquedas = 1;

} else {

    $busquedas = $_COOKIE["busquedas"];
    $busquedas++;
}

setcookie("busquedas", $busquedas, time() + (7 * 24 * 60 * 60), "/");


// COMPROBAR SI EXISTE EL DESTINO

if ($ac->existeDestino($destino) == true) {

    // Obtenemos los vuelos que cumplen las condiciones.
    $vuelos = $ac->obtenerVuelos($destino, $plazas);

    // Comprobamos si hemos encontrado vuelos.
    if (empty($vuelos) == true) {

        $mensajeError = "No hay vuelos con plazas disponibles con destino " . $destino;
        include_once "vistas/error.php";
        exit();
    }

    // Si hay vuelos, mostramos el listado.
    include_once "vistas/listado.php";

} else {

    // Si no existe el destino, mostramos el error.
    $mensajeError = "No hay vuelos con destino a " . $destino;
    include_once "vistas/error.php";
    exit();
}
?>