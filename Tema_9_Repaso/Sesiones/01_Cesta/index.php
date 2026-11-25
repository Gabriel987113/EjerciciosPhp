<?php
session_start();
// Creamos la cesta si no existe
if (!isset($_SESSION["cesta"])) $_SESSION["cesta"] = [];
$mensaje = "";
if (isset($_POST["anadir"])) {
    $p = $_POST["producto"];
    $n = (int)$_POST["unidades"];
    if ($n > 0) {
        if (isset($_SESSION["cesta"][$p])) $_SESSION["cesta"][$p] += $n;
        else $_SESSION["cesta"][$p] = $n;
        $mensaje = "Producto añadido.";
    } else $mensaje = "Indica unidades positivas.";
}
if (isset($_POST["quitar"])) {
    unset($_SESSION["cesta"][$_POST["quitar"]]);
    $mensaje = "Producto eliminado.";
}
if (isset($_POST["vaciar"])) {
    $_SESSION["cesta"] = [];
    $mensaje = "Cesta vaciada.";
}
?>
<!doctype html><html lang="es"><meta charset="utf-8"><title>Cesta</title><body>
<h1>Cesta de compra</h1><p><?= htmlspecialchars($mensaje) ?></p>
<form method="post">
<select name="producto"><option>Teclado</option><option>Ratón</option><option>Monitor</option></select>
<input type="number" name="unidades" min="1" value="1">
<button name="anadir">Añadir</button></form>
<h2>Productos guardados</h2>
<?php if (!$_SESSION["cesta"]): ?><p>Cesta vacía</p><?php else: ?>
<ul><?php foreach ($_SESSION["cesta"] as $p=>$n): ?>
<li><?= htmlspecialchars($p) ?>: <?= $n ?>
<form method="post" style="display:inline"><button name="quitar" value="<?= htmlspecialchars($p) ?>">Quitar</button></form></li>
<?php endforeach; ?></ul><?php endif; ?>
<form method="post"><button name="vaciar">Vaciar cesta</button></form>
</body></html>