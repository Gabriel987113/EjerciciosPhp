<?php
// Leemos la sección que se guardó en la visita anterior
$anterior = $_COOKIE["ultima"] ?? "";
$seccion = $_GET["seccion"] ?? "inicio";
$validas = ["inicio","noticias","deportes"];
if (!in_array($seccion, $validas, true)) $seccion = "inicio";
setcookie("ultima", $seccion, time()+7*24*60*60, "/");
$titulos = ["inicio"=>"Inicio","noticias"=>"Noticias","deportes"=>"Deportes"];
?>
<!doctype html><html lang="es"><meta charset="utf-8"><title>Secciones</title><body>
<h1><?= $titulos[$seccion] ?></h1>
<?php if ($anterior !== ""): ?><p>En tu visita anterior estabas en: <?= htmlspecialchars($anterior) ?></p>
<?php else: ?><p>Primera visita registrada.</p><?php endif; ?>
<a href="?seccion=inicio">Inicio</a> |
<a href="?seccion=noticias">Noticias</a> |
<a href="?seccion=deportes">Deportes</a>
</body></html>