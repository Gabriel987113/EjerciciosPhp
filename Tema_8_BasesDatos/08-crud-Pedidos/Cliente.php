<?php

class Cliente{

private $cod_cliente;
private $nombre;
private $clave;
private $veces;


public function __construct($cod_cliente, $nombre, $clave, $veces) {

    $this->cod_cliente = $cod_cliente;
    $this->nombre = $nombre;
    $this->clave = $clave;
    $this->veces = $veces;
   

}

public function __get($atributo) {
    return $this->$atributo;
}

public function __set($atributo, $valor) {
    $this->$atributo = $valor;
}
}


?>