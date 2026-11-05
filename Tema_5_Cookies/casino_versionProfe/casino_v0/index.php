<?php
session_start();

$msg="";
// Comprobar si el usuario quiere reiniciar la partida
if(isset($_GET["reiniciar"])){
  unset($_SESSION["disponible"]);
}

//CONTROLAR LAS VISITAS
if(isset($_COOKIE["visitas"])){
$visitas = $_COOKIE["visitas"] +1;
}else{
  $visitas = 1;
}

setcookie("visitas", $visitas, time() + (30 * 24 * 60 * 60));

// Entra en el casino --------------------------------
if (! isset($_SESSION['disponible'])) {//Comprobamos si existe dinero en la sesión.

    if(!isset($_POST['cantidadini'])){//Si no existe, comprobamos si el usuario ha enviado el dinero inicial.
      //Si no lo ha enviado, mostramos form_inicio.php y detenemos PHP.
     require_once "form_inicio.php";
      exit();
    }

    if($_POST["cantidadini"]<=0){
      require_once "form_inicio.php";
     exit();
    }

    //Si lo ha enviado, guardamos la cantidad en
    $_SESSION["disponible"] = $_POST["cantidadini"];
}


//comprobar si el usuario ha pulsado el botón Apostar cantidad y cargar la funcion que muesttra el mensaje.
if (isset($_POST["apostar"])) {
    $msg = procesarApuesta($_POST["cantidad"], $_SESSION["disponible"], $_POST["apuesta"]);
}

// Si abandona o ya no le queda dinero -------------------------
if (isset($_POST["dejar"]) || ($_SESSION["disponible"] == 0) ) {
  require_once "form_final.php";
   exit();
} 
// Muestro el formulario si puede seguir apostando
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorapuesta, int & $saldodisponible, string $apuesta): String {
  $msgresultado = "";
  $resultado="";

   if($valorapuesta<=0){
    return "No puedes apostar 0 euros";
   }else if($valorapuesta > $saldodisponible){
    return "No puedes apostar más dinero del que tienes";
   }else{
    $numAleatorio=rand(1,2);
    if($numAleatorio==1){
       $resultado="PAR";
    }else{
      $resultado="IMPAR";
    }
   }

   if($resultado==$apuesta){
    $msgresultado=" Has acertado, ha salido " . $resultado;
   $saldodisponible = $saldodisponible + $valorapuesta;
   }else{
    $msgresultado="Has fallado, ha salido " . $resultado;
   $saldodisponible = $saldodisponible - $valorapuesta;
   }
    
  return $msgresultado;
}

