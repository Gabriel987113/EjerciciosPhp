<?php

class Producto{

private $producto_no;
private $descripcion;
private $precio_actual;
private $stock_disponible;


public function __construct($producto_no, $descripcion, $precio_actual, $stock_disponible) {

    $this->producto_no = $producto_no;
    $this->descripcion = $descripcion;
    $this->precio_actual = $precio_actual;
    $this->stock_disponible = $stock_disponible;
   

}

public function __get($atributo) {
    return $this->$atributo;
}

public function __set($atributo, $valor) {
    $this->$atributo = $valor;
}
}


?>