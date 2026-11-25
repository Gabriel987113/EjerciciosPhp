<?php
session_start();

if(isset($_GET["accion"]) && $_GET["accion"] == "Anular"){
    session_destroy();
    $anulada = true;
}else{
    $anulada = false;
}

if(!$anulada){
if (!isset($_SESSION["contador"])) {
    $_SESSION["contador"] = 100;
}
}

if(isset($_GET["accion"])){
    if($_GET["accion"] == "Incrementar"){
        $_SESSION["contador"]++;
    }

    if($_GET["accion"] == "Decrementar"){
        $_SESSION["contador"]--;
    }
}



?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contador</title>
</head>

<body>
    <h2>Contador con sesión</h2>

    <?php
    if ($anulada == true) {
        echo "Sesion anulada";
        echo '<br><a href="contadorsesion.php"><button>Recargar</button></a>';
    } else {
        echo "Valor del contador: " . $_SESSION["contador"];
    ?>

        <form method="GET" action="contadorsesion.php">

            <input type="submit" name="accion" value="Incrementar">
            <input type="submit" name="accion" value="Decrementar">
            <input type="submit" name="accion" value="Anular">

        </form>

    <?php
    }
    ?>

</body>
</html>