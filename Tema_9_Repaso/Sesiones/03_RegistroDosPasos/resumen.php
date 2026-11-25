<?php
session_start();
if (!isset($_SESSION["nombre"], $_SESSION["ciudad"])) { header("Location: index.php"); exit; }
?>
<!doctype html><html lang="es"><meta charset="utf-8"><title>Resumen</title><body>
<h1>Registro terminado</h1>
<p>Nombre: <?= htmlspecialchars($_SESSION["nombre"]) ?></p>
<p>Ciudad: <?= htmlspecialchars($_SESSION["ciudad"]) ?></p>
<a href="borrar.php">Nuevo registro</a></body></html>