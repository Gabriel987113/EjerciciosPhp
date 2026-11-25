<?php
// Guardamos la elección durante 30 días
if (isset($_POST["guardar"])) {
    $tema = $_POST["tema"] ?? "claro";
    if (in_array($tema, ["claro","oscuro"], true)) {
        setcookie("tema", $tema, time()+30*24*60*60, "/");
        header("Location: index.php"); exit;
    }
}
$tema = $_COOKIE["tema"] ?? "claro";
?>
<!doctype html><html lang="es"><meta charset="utf-8"><title>Tema</title>
<style>body{font-family:Arial;padding:25px}.oscuro{background:#222;color:white}</style>
<body class="<?= htmlspecialchars($tema) ?>"><h1>Preferencia de tema</h1>
<p>Tema guardado: <?= htmlspecialchars($tema) ?></p>
<form method="post"><select name="tema"><option value="claro">Claro</option><option value="oscuro">Oscuro</option></select>
<button name="guardar">Guardar</button></form></body></html>