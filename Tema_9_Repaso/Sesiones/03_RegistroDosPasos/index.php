<?php
session_start();
// Guardamos el primer dato en la sesión
if (isset($_POST["continuar"])) {
    $_SESSION["nombre"] = trim($_POST["nombre"]);
    header("Location: paso2.php");
    exit;
}
?>
<!doctype html><html lang="es"><meta charset="utf-8"><title>Registro</title><body>
<h1>Paso 1: tus datos</h1><form method="post">
Nombre: <input name="nombre" required><button name="continuar">Continuar</button></form>
</body></html>