<?php
session_start();

include_once 'app/funciones.php';
include_once 'app/acciones.php';

//SI NO EXISTE LA VARIABLE DE SESION LA CREAMOS PONIENDOLE FALSE
if (!isset($_SESSION["acceso"])) {
    $_SESSION["acceso"] = false;
}

//SI HEMOS ENVIADO EL FORM Y EL PIN ES 12345, ACCESO PASARA A SER TRUE Y PODREMOS SEGUIR CON EL PROGRAMA
if (isset($_POST["pinAcceso"])) {
    if ($_POST["pinAcceso"] == "12345") {
        $_SESSION["acceso"] = true;
        //GUARDAMOS LA HORA EN UNA VARIBALE DE SESSION
        $_SESSION["tiempo"] = time();
    }
}

// SI HAN PASADO MÁS DE 5 MINUTOS, DESTRUIMOS LA SESIÓN
if($_SESSION["acceso"]==true && isset($_SESSION["tiempo"])){

if(time() - $_SESSION["tiempo"] > 300){
    session_destroy();
    header("Location: index.php"); //realiza una redirección y vuelve a cargar index.php desde el principio.
    exit();
}
}

//SI VALE FALSE NOS MOSTRARA EL FORMULARIO PARA PONER LE PIN
if ($_SESSION["acceso"] == false) {
    include_once "app/layout/formulariopin.php";
    exit();
}



// Div con contenido
$contenido="";
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    //Los case hacen referencia al valor (value) del elemento que se ha enviado en principal.php
    if ( isset($_GET['orden'])){
        switch ($_GET['orden']) {
            case "Nuevo"    : accionAlta(); break;
            case "Borrar"   : accionBorrar   ($_GET['id']); break;
            case "Modificar": accionModificar($_GET['id']); break;
            case "Detalles" : accionDetalles ($_GET['id']);break;
            case "Terminar" : accionTerminar(); break;
            //AÑADIMOS EN EL SWITCH LA NUEVO FUNCION PARA PODER INCREMENTAR SALDO
            case "Incrementar saldo": accionIncrementarSaldo(); break;
            //AÑADIMOS LA ACCION DE BLOQUEAR EN EL SWICTH
            case "Cambiar bloqueos": accionActualizarBloqueos(); break;
        }
    }
} 
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
         switch($_POST['orden']) {
             case "Nuevo"    : accionPostAlta(); break;
             case "Modificar": accionPostModificar(); break;
             case "Detalles":; // No hago nada
         }
    }
}
$contenido .= mostrarDatos();
// Muestro la página principal
include_once "app/layout/principal.php";




