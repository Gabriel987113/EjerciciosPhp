
<?php
/*
EJERCICIO:
Crea una página PHP llamada intentos.php para controlar
los intentos de acceso mediante sesiones.

- Inicializar intentos a 0.
- Solicitar una contraseña mediante un formulario.
- La contraseña correcta es 1234.
- Si es correcta, mostrar acceso permitido y reiniciar intentos.
- Si es incorrecta, incrementar los intentos.
- Al llegar a 3 intentos, bloquear el acceso.
- Permitir reiniciar la sesión.
*/

session_start();

// INICIALIZAMOS LOS INTENTOS
if (!isset($_SESSION["intentos"])) {
    $_SESSION["intentos"] = 0;
}

// COMPROBAMOS SI SE QUIERE REINICIAR
if (isset($_GET["accion"]) && $_GET["accion"] == "Reiniciar") {
    $_SESSION["intentos"] = 0;
}

// COMPROBAMOS SI SE HA ENVIADO LA CONTRASEÑA
if (isset($_POST["clave"]) && $_SESSION["intentos"] < 3) {

    if ($_POST["clave"] == "1234") {

        // REINICIAMOS LOS INTENTOS
        $_SESSION["intentos"] = 0;

        $mensaje = "Acceso permitido";

    } else {

        // AUMENTAMOS LOS INTENTOS
        $_SESSION["intentos"]++;

        if ($_SESSION["intentos"] == 3) {
            $mensaje = "Acceso bloqueado";
        } else {
            $mensaje = "Contraseña incorrecta";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Control de acceso</title>
</head>
<body>

    <h2>Inicio de sesión</h2>

    <?php
    if (isset($mensaje)) {
        echo $mensaje . "<br>";
    }

    echo "Intentos realizados: " . $_SESSION["intentos"];
    ?>

    <?php
    if ($_SESSION["intentos"] < 3) {
    ?>

        <form method="POST" action="intentos.php">
            Contraseña:
            <input type="password" name="clave">
            <input type="submit" value="Entrar">
        </form>

    <?php
    } else {
        echo "<p>No puedes volver a intentarlo</p>";
    }
    ?>

    <form method="GET" action="intentos.php">
        <input type="submit" name="accion" value="Reiniciar">
    </form>

</body>
</html>
