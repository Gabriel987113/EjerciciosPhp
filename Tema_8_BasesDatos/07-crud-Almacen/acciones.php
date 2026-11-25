<?php
/*
AccesoDatos.php: ejecuta las consultas SQL.
acciones.php: realiza las operaciones (consultar productos, actualizar precios).
consulta.php: decide qué mensaje mostrar al usuario.
*/

include_once "Producto.php";
include_once "AccesoDatos.php";

function accionMostrarProductos()
{
    $bd = AccesoDatos::initModelo();

    return $bd->getProductos10Stock();
}

function actualizarPrecios($tproductos) {
$bd = AccesoDatos::initModelo();

//recorre los códigos de los productos marcados.
foreach($tproductos as $producto_no){
    //Para cada código, llama a actualizarProductos().
      if ($bd->actualizarProductos($producto_no) == true) {

            // El producto se ha actualizado correctamente

        } else {

            // No se ha podido actualizar el producto

        }
}
}
