<?php

require_once "AccesoDatos.php";

//RECOGEMOS LOS DAROS ENVIADOS DESDE ACCESO.HTML
$usuario = $_GET["nombre"];
$clave = $_GET["clave"];

//Así podremos llamar a  las funciones que hay en Acceso datos mediante modelo
$modelo = AccesoDatos::initModelo();

$mensaje="";

// VALIDAMOS EL USUARIO
$cliente = $modelo->validarCliente($usuario, $clave);

if ($cliente == false) {

    $mensaje = "No están registrados ese nombre y contraseña";
    include_once "vistaerror.php";
    exit();

} else {
    
    $mensaje = "Bienvenido de nuevo " . $cliente->nombre;
   
}

//ha entrado en la tienda o ha iniciado sesión correctamente.
// ACTUALIZAMOS LAS VECES QUE HA ENTRADO EL CLIENTE
$cod_cliente = $cliente->cod_cliente;

if ($modelo->actualizarVecesEntradas($cod_cliente) == true) {

    // Si se actualiza la BD, actualizamos también el objeto
    $cliente->veces = $cliente->veces + 1;

}

/*
Imagina que Eva tiene veces = 2.
La base de datos pasa a tener 3, pero el objeto $cliente sigue teniendo 2.
por eso hayq eu hacer esto $cliente->veces = $cliente->veces + 1;
*/

// OBTENEMOS LOS PEDIDOS DEL CLIENTE
$pedidos = $modelo->getPedidos($cod_cliente);

// MOSTRAMOS LA VISTA CON LOS DATOS DEL CLIENTE Y SUS PEDIDOS
include_once "vistapedidos.php";

// Obtenemos todos los pedidos del cliente y los guardamos en un array.
// Si no tiene pedidos, el array estará vacío.(como nos devuelve un arrray la funcion 
//pedidos sera el array)

?>