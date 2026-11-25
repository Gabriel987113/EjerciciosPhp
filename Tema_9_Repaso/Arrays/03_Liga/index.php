<?php
$equipos = [
 ["nombre"=>"Lobos","ganados"=>4,"empatados"=>1,"perdidos"=>1],
 ["nombre"=>"Tigres","ganados"=>3,"empatados"=>2,"perdidos"=>1],
 ["nombre"=>"Águilas","ganados"=>2,"empatados"=>1,"perdidos"=>3]
];
// Cada victoria vale 3 puntos y cada empate 1
foreach ($equipos as $i=>$e) $equipos[$i]["puntos"] = $e["ganados"]*3 + $e["empatados"];
// Ordenamos de mayor a menor puntuación
usort($equipos, fn($a,$b) => $b["puntos"] <=> $a["puntos"]);
?>
<!doctype html><html lang="es"><meta charset="utf-8"><body><h1>Clasificación</h1>
<table border="1"><tr><th>Equipo</th><th>Ganados</th><th>Empates</th><th>Puntos</th></tr>
<?php foreach ($equipos as $e): ?><tr><td><?= $e["nombre"] ?></td><td><?= $e["ganados"] ?></td><td><?= $e["empatados"] ?></td><td><?= $e["puntos"] ?></td></tr><?php endforeach; ?>
</table></body></html>