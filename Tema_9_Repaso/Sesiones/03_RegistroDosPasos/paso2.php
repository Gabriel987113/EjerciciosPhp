<?php
session_start();
if (!isset($_SESSION["nombre"])) { header("Location: index.php"); exit; }
if (isset($_POST["terminar"])) {
    $_SESSION["ciudad"] = trim($_POST["ciudad"]);
    header("Location: resumen.php"); exit;
}
?>
<!doctype html><html lang="es"><meta charset="utf-8"><title>Paso 2</title><body>
<h1>Paso 2</h1><p>Hola <?= htmlspecialchars($_SESSION["nombre"]) ?></p>
<form method="post">Ciudad: <input name="ciudad" required><button name="terminar">Terminar</button></form>
</body></html>