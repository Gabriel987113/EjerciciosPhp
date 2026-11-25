<?php
include_once "Producto.php";
include_once "Socio.php";
include_once "AccesoDatos.php";

$cod_socio = $_POST["cod_socio"];
$clave = $_POST["clave"];
$cod_pro = $_POST["cod_pro"];
$mensaje = "";

// VALIDAMOS EL SOCIO
function accionValidarSocio($cod_socio, $clave)
{
    $bd = AccesoDatos::initModelo();

    $socio = $bd->validarSocio($cod_socio, $clave);

    if ($socio != false) {
        return $socio;
    } else {
        return false;
    }
}

// BUSCAMOS EL PRODUCTO
function accionBuscarProducto($cod_pro)
{
    $bd = AccesoDatos::initModelo();

    $producto = $bd->buscarProducto($cod_pro);

    if ($producto != false) {
        return $producto;
    } else {
        return false;
    }
}

// ACTUALIZAMOS LA CANTIDAD MAX
function actualizarCantidad($cod_socio, $precio)
{
    $bd = AccesoDatos::initModelo();

    if ($bd->actualizarCantidadMax($cod_socio, $precio) == true) {
        return true;
    } else {
        return false;
    }
}

// COMPROBAMOS SI EL SOCIO EXISTE
$socio = accionValidarSocio($cod_socio, $clave);

if ($socio == false) {

    $mensaje = "ERROR: Los valores de código de cliente y contraseña no son válidos";

} else {

    // MOSTRAMOS BIENVENIDA
    $mensaje = "BIENVENIDO/A " . $socio->nombre;

    // COMPROBAMOS SI EXISTE EL PRODUCTO
    $producto = accionBuscarProducto($cod_pro);

    if ($producto == false) {

        $mensaje = "No se encuentra ningún producto con el código " . $cod_pro . " en nuestro catálogo";

    } else {

        // COMPROBAMOS SI TIENE DINERO SUFICIENTE
        if ($producto->precio <= $socio->cantidad_max) {

            // ACTUALIZAMOS LA CANTIDAD DISPONIBLE
            $resultado = actualizarCantidad($cod_socio, $producto->precio);

            if ($resultado == true) {

                $nuevaCantidad = $socio->cantidad_max - $producto->precio;

                $mensaje .= "Compra realizada correctamente.<br>";
                $mensaje .= "Código del producto: " . $producto->cod_pro . "<br>";
                $mensaje .= "Nombre del producto: " . $producto->nombre_pro . "<br>";
                $mensaje .= "Precio: " . $producto->precio . "<br>";
                $mensaje .= "Nueva cantidad máxima disponible: " . $nuevaCantidad;

            } else {

                $mensaje = "No se ha podido actualizar la compra";

            }

        } else {

            $mensaje = "No tienes suficiente cantidad disponible para realizar la compra.<br>";
            $mensaje .= "Código del producto: " . $producto->cod_pro . "<br>";
            $mensaje .= "Nombre del producto: " . $producto->nombre_pro . "<br>";
            $mensaje .= "Precio: " . $producto->precio . "<br>";
            $mensaje .= "Cantidad máxima disponible: " . $socio->cantidad_max;

        }
    }
}

// MOSTRAMOS EL MENSAJE
echo $mensaje;

?>