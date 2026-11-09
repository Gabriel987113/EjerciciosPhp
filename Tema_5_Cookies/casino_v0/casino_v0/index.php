<?php
session_start();

$msg = "";
$visita = 0;
/*
PHP detecta que el formulario se ha enviado, 
aunque la cantidad esté vacía o sea incorrecta.con cantidad ini
*/


// Entra en el casino  y controlamos las visitas
if (! isset($_SESSION['disponible'])) {

  if (!isset($_COOKIE["visitas"])) { //comprobmaos que existe la cookie viistas, si no existe..
    $visita = 1;
    //creamos la cookie
    setcookie("visitas", $visita, time() + 30 * 24 * 60 * 60); //creamos la cookie donde su valor incial sera 1
  } else if (isset($_COOKIE["visitas"])) { //si existe la cookie visitas

    if(!isset($_POST["cantidadini"])){ //si aun no se ha enviado la cantidadini
      $visita = $_COOKIE["visitas"] + 1; //se sumara una visita
       //Si la cookie ya existe con ese nombre de la cookie("visitas"), setcookie() sobrescribe su valor con el nuevo.
    setcookie("visitas", $visita, time() + 30 * 24 * 60 * 60);
    }
  }

  if (!isset($_POST["cantidadini"]) || $_POST["cantidadini"] <= 0) {
    include_once("form_bienvenida.php");
    exit();
  }

  $_SESSION["disponible"] = $_POST["cantidadini"];
}



// Si realiza una apuesta ----------------------------------
// llama a procesar apuesta 
if (isset($_POST["apostar"])) {
  $msg = procesarApuesta($_POST["cantidad"], $_SESSION["disponible"], $_POST["apuesta"]);
}

// Si abandona o ya no le queda dinero -------------------------
if (isset($_POST["dejar"]) || ($_SESSION["disponible"] == 0)) {
  $msg = "Has decidido abandonar el casino o ya no te queda dinero";
  require_once "despedida.php";

  //elimina únicamente esa variable de sesión.
  unset($_SESSION["disponible"]);

  //session_destroy(): destruye toda la sesión,
  // es decir, elimina los datos asociados a ella.
  exit();
}
// Muestro el formulario si puede seguir apostando
require_once  "form_apuesta.php";
?>


<?php

/**
 *  FUNCIONES AUXILIARES
 */

function procesarApuesta(int $valorApuesta, int &$saldoDisponible, string $tipoApuesta): String
{
  $msgresultado = "";

  if ($valorApuesta <= 0) {
    return "Debes introducir una cantidad superior a 0";
  } else if ($valorApuesta > $saldoDisponible) {
    return "Debes introducir una cantidad inferior al saldo Disponible";
  }else {
    $resultadoApuesta = "";
    $numAleatorio = rand(1, 2);

    if ($numAleatorio == 1) {
      $resultadoApuesta = "PAR";
    } else if ($numAleatorio == 2) {
      $resultadoApuesta = "IMPAR";
    }

    if ($resultadoApuesta == $tipoApuesta) {
      $msgresultado = "Has Acertado ha salido " . $resultadoApuesta . " has ganado " . $valorApuesta;
      $saldoDisponible = $saldoDisponible + $valorApuesta;
    } else {
      $msgresultado = "No has acertado, ha salido " . $resultadoApuesta . "has perdido " . $valorApuesta;
      $saldoDisponible = $saldoDisponible - $valorApuesta;
    }
  }
  return $msgresultado;
}
