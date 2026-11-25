<?php

class Pedido{

private $numped;
private $cod_cliente;
private $producto;
private $precio;


public function __construct($numped, $cod_cliente, $producto,  $precio ) {

    $this->numped = $numped;
    $this->cod_cliente = $cod_cliente;
    $this->producto = $producto;
    $this->precio = $precio;
   
}

public function __get($atributo) {
    return $this->$atributo;
}

public function __set($atributo, $valor) {
    $this->$atributo = $valor;
}

}


?>