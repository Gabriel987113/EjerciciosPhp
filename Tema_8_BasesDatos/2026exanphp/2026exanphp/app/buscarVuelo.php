<?php
session_start();

require_once 'modelo/Vuelo.php';
require_once 'modelo/AccesoDatos.php';
require_once 'tools.php';



$destino = $_GET['destino'];

$ac = AccesoDatos::initModelo();

if ( $destino == "Madrid") {
        include 'vistas/listado.php';
    } else {
        include 'vistas/error.php';
    }




 
