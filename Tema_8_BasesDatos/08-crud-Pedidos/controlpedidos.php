
<?php

require_once "AccesoDatos.php";

// ACCIÓN 1: VALIDAR EL CLIENTE
function accionValidarCliente($usuario, $clave) {
    $modelo = AccesoDatos::initModelo();

    return $modelo->validarCliente($usuario, $clave);
}

// ACCIÓN 2: ACTUALIZAR LAS VECES QUE HA ENTRADO
function accionActualizarVeces($cod_cliente) {
    $modelo = AccesoDatos::initModelo();

    return $modelo->actualizarVecesEntradas($cod_cliente);
}

// ACCIÓN 3: OBTENER LOS PEDIDOS DEL CLIENTE
function accionObtenerPedidos($cod_cliente) {
    $modelo = AccesoDatos::initModelo();

    return $modelo->getPedidos($cod_cliente);
}


// --------------------------------------------------
// PARTE PRINCIPAL DEL CONTROLADOR
// --------------------------------------------------

// Recogemos los datos del formulario
$usuario = $_GET["nombre"];
$clave = $_GET["clave"];

$mensaje = "";

// VALIDAR CLIENTE
$cliente = accionValidarCliente($usuario, $clave);

if ($cliente == false) {

    $mensaje = "No están registrados ese nombre y contraseña";

    include_once "vistaerror.php";
    exit();

} else {

    $mensaje = "Bienvenido de nuevo " . $cliente->nombre;
}

// ACTUALIZAR LAS VECES QUE HA ENTRADO
$cod_cliente = $cliente->cod_cliente;

if (accionActualizarVeces($cod_cliente) == true) {

    // Actualizamos también el objeto
    $cliente->veces++;
}

// OBTENER LOS PEDIDOS
$pedidos = accionObtenerPedidos($cod_cliente);

// MOSTRAR LA VISTA
include_once "vistapedidos.php";

?>
