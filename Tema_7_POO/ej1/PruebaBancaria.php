<?php
include_once'CuentaBancaria.php';
echo "<h2> PROBANDO </H2>";

$cuenta1 = new CuentaBancaria(100);
$cuenta2 = new CuentaBancaria(1900);
$cuenta3 = new CuentaBancaria();

$cuenta1->abono(20);
$cuenta2->ingreso(10);
$cuenta3->anotarGastos();
echo "<br> Cuenta 1 = " . $cuenta1->consultarEstado();

$cuenta2->ingreso(100);
$cuenta2->anotarGastos();
$cuenta2->anotarIntereses(5);
$cuenta2->transferencia(100,$cuenta3);
echo"<br> Cuenta 2 = " . $cuenta2->consultarEstado();

$cuenta3->abono(75);
$cuenta3->abono(75); // Se queda con saldo negativo
echo "<br> Cuenta c3 = ".$cuenta3->consultarEstado();

?>