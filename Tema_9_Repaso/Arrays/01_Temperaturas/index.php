<?php
$temperaturas = [12,18,7,25,31,16,9,22];
$suma = 0; $max = $temperaturas[0]; $min = $temperaturas[0];
$frescos = 0; $calurosos = 0;
foreach ($temperaturas as $t) {
    $suma += $t;
    if ($t > $max) $max = $t;
    if ($t < $min) $min = $t;
    if ($t < 15) $frescos++;
    elseif ($t >= 25) $calurosos++;
}
$media = $suma / count($temperaturas);
?>
<!doctype html><html lang="es"><meta charset="utf-8"><body><h1>Temperaturas</h1>
<p>Media: <?= number_format($media,2) ?></p><p>Máxima: <?= $max ?></p><p>Mínima: <?= $min ?></p>
<p>Días frescos: <?= $frescos ?></p><p>Días calurosos: <?= $calurosos ?></p></body></html>