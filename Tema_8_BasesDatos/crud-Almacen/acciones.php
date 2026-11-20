<?php

include_once "Producto.php";
include_once "AccesoDatos.php";
include_once "acciones.php";

// FECHA DE HOY
$hoy = date("Y-m-d");

// MUESTRA TODOS LOS Productos
function mostrarDatos (){
    
    $titulos = [ "codigo","nombre","stock","stock_min","precio"];
    $msg = "<table>\n";
     // Identificador de la tabla
    $msg .= "<tr>";
    for ($i=0; $i < count($titulos); $i++){
        $msg .= "<th>$titulos[$i]</th>";
    }  
    $msg .= "</tr>";
    $auto = $_SERVER['PHP_SELF'];
    $db = AccesoDatos::getModelo();
    $tproductos = $db->getProductos();
    foreach ($tproductos as $producto) {
        $msg .= "<tr>";
        $msg .= "<td>$producto->codigo</td>";
        $msg .= "<td>$producto->nombre</td>";
        $msg .= "<td>$producto->stock</td>";
        $msg .= "<td>$producto->stock_min</td>";
        $msg .= "<td>$producto->precio</td>";
        $msg .="<td><a href=\"#\" onclick=\"confirmarBorrar('$producto->nombre','$producto->codigo');\" >🗑️</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Modificar&id=$producto->codigo\">✏️</a></td>\n";
        $msg .="<td><a href=\"".$auto."?orden=Detalles&id=$producto->codigo\" >👁️</a></td>\n";
        $msg .="</tr>\n";
        
    }
    $msg .= "</table>";
   
    return $msg;    
}

?>

