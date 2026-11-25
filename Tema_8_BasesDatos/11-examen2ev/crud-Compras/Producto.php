<?php

class Producto {

private $cod_pro;
private $nombre_pro;
private $precio;


public function __construct($cod_pro, $nombre_pro, $precio) {

    $this->cod_pro = $cod_pro;
    $this->nombre_pro = $nombre_pro;
    $this->precio = $precio;

}

public function __get($atributo) {
    return $this->$atributo;
}

public function __set($atributo, $valor) {
    $this->$atributo = $valor;
}
}
