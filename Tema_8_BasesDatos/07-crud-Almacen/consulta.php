
<?php
/*
- "actualizar": nombre de la cookie.
- $hoy: valor que guardamos (la fecha actual).
- time() + 86400: cuándo caduca (24 horas después).
*/
include_once "acciones.php";

// INICIALIZAR EL MENSAJE
$mensaje = "";

// OBTENER LOS PRODUCTOS
$tproductos = accionMostrarProductos();

// COMPROBAR SI SE HA PULSADO el boton del formulario ACTUALIZAR
if (isset($_POST["ordenActualizar"])) {

    // COMPROBAR SI SE HA SELECCIONADO ALGÚN PRODUCTO 
    if (isset($_POST["tproductos"])) {

        // OBTENER LA FECHA ACTUAL
        $hoy = date("Y-m-d");

        // COMPROBAR SI YA SE HA ACTUALIZADO HOY
        if (isset($_COOKIE["actualizar"]) && $_COOKIE["actualizar"] == $hoy) {

            $mensaje = "Hoy ya has actualizado los precios";

        } else {

            // ACTUALIZAR LOS PRODUCTOS SELECCIONADOS
            actualizarPrecios($_POST["tproductos"]);

            // GUARDAR LA FECHA DE ACTUALIZACIÓN EN LA COOKIE
            setcookie("actualizar", $hoy, time() + 86400);

            $mensaje = "Los precios se han actualizado correctamente";
        }

    } else {

        $mensaje = "Debes seleccionar al menos un producto";
    }
}

// VOLVER A CONSULTAR LOS PRODUCTOS PARA MOSTRAR LOS PRECIOS ACTUALIZADOS
$tproductos = accionMostrarProductos();

?>




<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <link href="default.css" rel="stylesheet" type="text/css" />
</head>

<body>

    <div id="container" style="width: 600px;">

        <div id="header">
            <h1>BAJAR PRECIOS PRODUCTOS SIN PEDIDOS</h1>
        </div>

        <div id="content">

            <?php
            if ($mensaje != "") {
                echo $mensaje;
            }
            ?>

            <form name="entrada" method="post">

                <table>

                    <tr>
                        <th></th>
                        <th>no</th>
                        <th>Descripción</th>
                        <th>stock</th>
                        <th>precio</th>
                    </tr>

                    <?php foreach ($tproductos as $pro): ?>

                        <tr>

                            <td>
                                <input type="checkbox" name="tproductos[]" value="<?= $pro->producto_no ?>">
                            </td>
                            <td><?= $pro->producto_no ?></td>

                            <td><?= $pro->descripcion ?></td>

                            <td><?= $pro->stock_disponible ?></td>

                            <td><?= $pro->precio_actual ?></td>

                        </tr>

                    <?php endforeach; ?>
                </table>

                <br>

                <input type="submit" name="ordenActualizar" value="ACTUALIZAR">

            </form>

        </div>

    </div>

</body>

</html>