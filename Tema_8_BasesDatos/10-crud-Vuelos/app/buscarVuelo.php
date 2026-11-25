
<?php
session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';


// 1. VALIDAR EL NUMERO DE PLAZAS
function validarPlazas($plazas)
{
    if (!is_numeric($plazas)) {
        return false;
    }
     //comprueba que $plazas sea un número entero entre 1 y 5.
    if (filter_var($plazas, FILTER_VALIDATE_INT) === false || $plazas < 1 || $plazas > 5) {
        return false;
    }

    return true;
}


// 2. CONTAR LAS BUSQUEDAS CON UNA COOKIE
function contarBusquedas()
{
    if (!isset($_COOKIE["busquedas"])) {
        $busquedas = 1;
    } else {
        $busquedas = $_COOKIE["busquedas"] + 1;
    }

    //Ese último parámetro "/" significa que la cookie estará disponible en todas las páginas y carpetas de tu proyecto web.
    setcookie("busquedas", $busquedas, time() + (7 * 24 * 60 * 60), "/");

    return $busquedas;
}


// 3. OBTENER LOS VUELOS
function accionBuscarVuelos($destino, $plazas)
{
    $ac = AccesoDatos::initModelo();

    // Comprobamos si existe el destino.
    if ($ac->existeDestino($destino) == false) {
        return false;
    }

    // Obtenemos los vuelos que cumplen las condiciones.
    $vuelos = $ac->obtenerVuelos($destino, $plazas);

    return $vuelos;
}


// ------------------------------------------------
// PARTE PRINCIPAL DEL CONTROLADOR
// ------------------------------------------------

$destino = $_GET['destino'];
$plazas = $_GET['plazas'];
$mensajeError = "";

// VALIDAMOS LAS PLAZAS
if (validarPlazas($plazas) == false) {

    $mensajeError = "El Nº de plazas no es correcto, debe estar entre 1 y 5";
    include_once "vistas/error.php";
    exit();
}


// CONTAMOS LAS BUSQUEDAS
$busquedas = contarBusquedas();


// BUSCAMOS LOS VUELOS
$vuelos = accionBuscarVuelos($destino, $plazas);


// COMPROBAMOS EL RESULTADO
if ($vuelos == false) {

    $mensajeError = "No hay vuelos con destino a " . $destino;
    include_once "vistas/error.php";
    exit();

} else if (empty($vuelos)) {

    $mensajeError = "No hay vuelos con plazas disponibles con destino " . $destino;
    include_once "vistas/error.php";
    exit();

} else {

    // Si hay vuelos, mostramos el listado.
    include_once "vistas/listado.php";
}

?>
