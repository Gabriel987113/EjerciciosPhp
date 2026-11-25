<?php

class Socio {

private $cod_socio;
private $nombre;
private $clave;
private $cantidad_max;


public function __construct($cod_socio, $nombre, $clave, $cantidad_max) {

    $this->cod_socio = $cod_socio;
    $this->nombre = $nombre;
    $this->clave = $clave;
    $this->cantidad_max = $cantidad_max;
    

}

public function __get($atributo) {
    return $this->$atributo;
}

public function __set($atributo, $valor) {
    $this->$atributo = $valor;
}
}
