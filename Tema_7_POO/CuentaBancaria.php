<?php

class CuentaBancaria{

//ATRIBUTOS DE LA CLASE
private $saldo;
private $numMovimientos;
private static $numCuentas = 0;


//METODOS
//solo van en el paréntesis los atributos cuyo valor 
//viene de fuera, es decir, los que te tienen que dar al crear el objeto.
public function __construct(int $saldo=0){
    $this->saldo=$saldo;
    $this->numMovimientos=0;
    self::$numCuentas++; // se hace self con los atributos que son static.
}

//Ingreso, incrementa el saldo en una cantidad indicada como parámetro.
public function ingreso(int $cantidad){ //el valor del parentesis solo se aplica si creas el objeto vacio.
    $this->saldo=$this->saldo+$cantidad;
    $this->numMovimientos++;
}

// Abono, decremento el saldo en la cantidad indicada como parámetro.
public function abono(int $cantidad){
    $this->saldo=$this->saldo-$cantidad;
    $this->numMovimientos++;
}

// Anotar gastos decrementa el saldo en 20 euros si
// el saldo de la cuenta es menor 1000
public function anotarGastos(){
    if($this->saldo<1000){
        $this->saldo=$this->saldo - 20;
        $this->numMovimientos++;
    }
}

// Anotar Intereses incrementa la cuenta según valor de interés indicado
// como parámetro en tanto por ciento.
public function anotarIntereses(int $interes){

$this->saldo=$this->saldo + (($this->saldo*$interes)/100);
$this->numMovimientos++;
}

//Realizar transferencia a cuenta, decrementa el saldo
// en la cantidad indicada
// como parámetro, realizando un ingreso en la cuenta destino
public function transferencia (int $importe, CuentaBancaria $destino){
    $this->abono($importe);
    $destino->ingreso($importe);
}

// Consultar estado de la cuenta, mostrá el saldo actual y
// el número de operaciones realizadas
public function consultarEstado():string{
  return "Saldo:" . $this->saldo . " " .   "Nº operaciones:" . $this->numMovimientos;
}
}

?> 