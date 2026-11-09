<?php
session_start();

include_once('app/funciones.php');

//Si no existe la variable de session  se crea y se le asigna el valor 0.
if(!isset($_SESSION["intentos"])){
     $_SESSION["intentos"]=0;
}

// si la variable de sesion vale 5 saldra ese mensaje y se finalizara el php.
if($_SESSION["intentos"] >=5){
   $contenido = "has superado el maximo de intentos posibles (5)";
   include_once "app/acceso.php";
   exit();
}

if (  !empty( $_GET['login']) && !empty($_GET['clave'])){
    if ( userOk($_GET['login'],$_GET['clave'])){
      if ( getUserRol($_GET['login']) == ROL_PROFESOR){
        $_SESSION["intentos"]=0;
        $contenido = verNotaTodas($_GET['login']);
      } else {
        $_SESSION["intentos"]=0;
        $contenido = verNotasAlumno($_GET['login']);
      }
      include_once ('app/resultado.php');
    } 
    // userOK falso
    else {
       $contenido = "El número de usuario y la contraseña no son válidos";
       $_SESSION["intentos"]++;

        if($_SESSION["intentos"] >=5){
          $contenido = "has superado el maximo de intentos posibles (5)";
          include_once "app/acceso.php";
          exit();
        } 
       include_once('app/acceso.php');
    }
} else {
    $contenido = " Introduzca su número de usuario y su contraseña";
    include_once('app/acceso.php');
}


