<?php
/*
 * Prueba de la mejora: reloj con alarma
 */
include_once 'Reloj.php';

$r = new Reloj(7, 29, 58);
$r->fijarAlarma(7, 30);      // alarma a las 07:30
$r->activarAlarma(true);     // la activo

echo "<h2>PROBANDO LA ALARMA</h2>";
echo "Hora inicial: " . $r->mostrar();

for ($i = 1; $i <= 3; $i++) {
    $r->tictac();
    echo "<br>Tictac $i -> " . $r->mostrar();
}

// Ahora la desactivo y compruebo que ya no suena
$r->activarAlarma(false);
$r2 = new Reloj(7, 29, 59);
$r2->fijarAlarma(7, 30);
$r2->tictac();
echo "<br><br>Con la alarma desactivada no suena: " . $r2->mostrar();