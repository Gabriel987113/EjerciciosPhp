<?php
session_start();
$opciones = ["Deporte", "Música", "Cine"];
$mensaje = "";
if (isset($_SESSION["voto"])) {
    $mensaje = "Ya has votado en esta sesión: " . $_SESSION["voto"];
} elseif (isset($_POST["votar"])) {
    $respuesta = $_POST["aficion"] ?? "";
    if (in_array($respuesta, $opciones, true)) {
        $_SESSION["voto"] = $respuesta;
        $mensaje = "Voto registrado.";
    } else $mensaje = "Elige una opción válida.";
}
?>
<!doctype html><html lang="es"><meta charset="utf-8"><title>Encuesta</title><body>
<h1>¿Cuál es tu afición favorita?</h1><p><?= htmlspecialchars($mensaje) ?></p>
<?php if (!isset($_SESSION["voto"])): ?><form method="post">
<?php foreach ($opciones as $o): ?><label><input type="radio" name="aficion" value="<?= $o ?>" required><?= $o ?></label><br><?php endforeach; ?>
<button name="votar">Votar</button></form><?php endif; ?>
<p><a href="reiniciar.php">Reiniciar sesión de prueba</a></p></body></html>