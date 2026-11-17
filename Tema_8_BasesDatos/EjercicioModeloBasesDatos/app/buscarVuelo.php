<?php
session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';


$destino = $_GET['destino'];
$plazas = $_GET['plazas'];

$ac = AccesoDatos::initModelo();

//Comprobar que el numero de plazas esta entre 1 y 5-----------------------------
//Comprueba si el valor de $plazas es un número entero válido. lo del filter
if(is_numeric($plazas)){
if(filter_var($plazas, FILTER_VALIDATE_INT) === false || $plazas < 1 || $plazas > 5){
    $mensajeError = "El Nº de plazas no es correcto debe estar entre 1 y 5";
    include_once "vistas/error.php";
    exit();
}
}else{
    $mensajeError = "Debes introducir un numero en las plazas";
    include_once "vistas/error.php";
    exit();
}

//COMPROBAR SI EXISTE EL DESTINO------------------------------------

if($ac->existeDestino($destino)==true){

  // Obtenemos los vuelos que cumplen las condiciones.
  $vuelos = $ac->obtenerVuelos($destino, $plazas);

  //comprueba si hemos encontrado vuelos que además tengan suficientes plazas.
  if(empty($vuelos)==true){
    $mensajeError="No hay vuelos con plazas disponibles con destino " . $destino;
    include_once "vistas/error.php";
    exit();
  }

    // Si hay vuelos, mostramos el listado.
  include_once "vistas/listado.php";

}else{
    // Si no existe el destino, mostramos el error.
    $mensajeError = "No hay vuelos con destino a " . $destino;
    include_once "vistas/error.php";
    exit();
}



 
