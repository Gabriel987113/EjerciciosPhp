<?php

class Vuelo {

private $cod_vuelo;
private $destino;
private $aerolinea;
private $clase;
private $precio_billete;
private $asientos_libres;

public function __construct($cod_vuelo, $destino, $aerolinea, $clase, $precio_billete, $asientos_libres) {

    $this->cod_vuelo = $cod_vuelo;
    $this->destino = $destino;
    $this->aerolinea = $aerolinea;
    $this->clase = $clase;
    $this->precio_billete = $precio_billete;
    $this->asientos_libres = $asientos_libres;

}

public function __get($atributo) {
    return $this->$atributo;
}

public function __set($atributo, $valor) {
    $this->$atributo = $valor;
}
}
