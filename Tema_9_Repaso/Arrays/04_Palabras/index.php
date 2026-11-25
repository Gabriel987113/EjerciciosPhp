<?php
$frase = "sol luna sol mar luna sol";
$palabras = explode(" ", $frase);
$recuento = [];
// Contamos cada palabra
foreach ($palabras as $p) {
    if (isset($recuento[$p])) $recuento[$p]++;
    else $recuento[$p] = 1;
}
$repetidas = [];
foreach ($recuento as $p=>$veces) if ($veces > 1) $repetidas[] = $p;
?>
<!doctype html><html lang="es"><meta charset="utf-8"><body><h1>Recuento</h1>
<p>Frase: <?= htmlspecialchars($frase) ?></p><ul>
<?php foreach ($recuento as $p=>$veces): ?><li><?= htmlspecialchars($p) ?>: <?= $veces ?></li><?php endforeach; ?>
</ul><p>Repetidas: <?= implode(", ",$repetidas) ?></p></body></html>