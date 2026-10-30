<?php

session_start();
/*
"numeroSecreto" no es una variable. 
estamos creando ese dato de sesion y dandole un valor.
dato guardado en la sesion. que no es lo mismo que crear
$numeroSecreto a secas, eso es una variable normal de php.
*/

/*
Si todavia no existe el numero secreto, estamos empezando el 
juego, asi que generamos el numero y damos las 5 oportunidades.

Despues, cuando el usuario haga otro intento, numeroSecreto 
ya existe, por lo que no vuelve a entrar en el if y las
 oportunidades no vuelven a 5.
*/
$partidaTerminada=false;

/* REINICIAR PARTIDA */
if(isset($_GET["reiniciar"])){ //Se ha pulsado el enlace de Reintentar?
    unset($_SESSION["numeroSecreto"]); //unset() elimina el número secreto que teníamos guardado.
    unset($_SESSION["oportunidades"]);
    header("Location: adivina.php"); //significa:"Navegador, vuelve a cargar/ir a adivina.php."
    exit();
}

/* CREAR PARTIDA */
if(!isset($_SESSION["numeroSecreto"])){ //si no existe el numero secreto se crea y con sus intentos
    $_SESSION["numeroSecreto"] = rand(1,20);
    $_SESSION["oportunidades"] = 5;
}

/* INTENTO DEL USUARIO */
if(isset($_POST["numero"])){
    $numeroUsuario = $_POST["numero"];
    $_SESSION["oportunidades"]--;

    if($numeroUsuario > $_SESSION["numeroSecreto"]){
        echo "El numero secreto es inferior";
    }else if($numeroUsuario < $_SESSION["numeroSecreto"]){
        echo "El numero secreto es mayor";
    }else{
        echo "Has acertado! El numero secreto era: " . $_SESSION["numeroSecreto"];
        $partidaTerminada = true;
    }

    /* COMPROBAR SI HA PERDIDO */
    if($_SESSION["oportunidades"] == 0){
        echo "HAS perdido. No puedes realizar mas intentos";
        $partidaTerminada=true;
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php if(!$partidaTerminada) { ?>
    <form action="" method="post"> 
         <input type="number" name="numero">
         <input type="submit" value="Adivinar">
         <!--usamos get en reintentarn porque necesita enviar un dato que haya
          escrito el usuario. Simplemente queremos decir:
          "Quiero reiniciar la partida."-->
    </form>
<?php } ?>
     <a href="adivina.php?reiniciar=1">Reintentar</a>
</body>
</html>