<?php
include_once "Usuario.php";

function accionBorrar ($login){    
    $db = AccesoDatos::getModelo();
    $tuser = $db->borrarUsuario($login);
}

function accionTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
    header("Location: index.php");
    exit();
}
 
function accionAlta(){
    $user = new Usuario("", "", "", "", 0, 0);
   
    $orden= "Nuevo";
    include_once "layout/formulario.php";
}

function accionDetalles($login){
    $db = AccesoDatos::getModelo();
    $user = $db->getUsuario($login);
    $orden = "Detalles";
    include_once "layout/formulario.php";
}


function accionModificar($login){
    $db = AccesoDatos::getModelo();
    $user = $db->getUsuario($login);
    $orden="Modificar";
    include_once "layout/formulario.php";
}

function accionPostAlta(){
    limpiarArrayEntrada($_POST);

    $user = new Usuario(
        $_POST['nombre'],
        $_POST['login'],
        $_POST['clave'],
        $_POST['comentario'],
        0,
        0
    );

    $db = AccesoDatos::getModelo();
    $db->addUsuario($user);
}

function accionPostModificar(){
    limpiarArrayEntrada($_POST);

    $user = new Usuario(
        $_POST['nombre'],
        $_POST['login'],
        $_POST['clave'],
        $_POST['comentario'],
        0,
        0
    );

    $db = AccesoDatos::getModelo();
    $db->modUsuario($user);
}

function accionIncrementarSaldo()
{
    $db = AccesoDatos::getModelo();

    // Comprobamos que se haya seleccionado algún usuario.
    //"usuarios[]" es el array que creamos en los checkbox de mostrarDatos().
    // $msg .= "<td><input type='checkbox' name='usuarios[]' value='$user->login'></td>";
    if (isset($_GET["usuarios"])) {

        // Recorremos los usuarios seleccionados.
        foreach ($_GET["usuarios"] as $login) {
            $db->incrementarSaldo($login);
        }
    }
}

function accionActualizarBloqueos(){
    $db = AccesoDatos::getModelo();

    if(isset($_GET["usuarios"])){
        foreach($_GET["usuarios"] as $login){
            $db->actualizarBloqueos($login);
        }
    }
}

