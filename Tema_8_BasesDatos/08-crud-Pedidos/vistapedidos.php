
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos del cliente</title>
</head>
<body>

    <?php

    // MOSTRAMOS EL MENSAJE DE BIENVENIDA
    echo "<h2>" . $mensaje . "</h2>";

    // MOSTRAMOS LAS VECES QUE HA ENTRADO EL CLIENTE
    echo "<p>Has entrado " . $cliente->veces . " veces.</p>";


    // COMPROBAMOS SI EL CLIENTE TIENE PEDIDOS
    if (empty($pedidos)) {

        // SI EL ARRAY ESTÁ VACÍO, SIGNIFICA QUE NO TIENE PEDIDOS
        echo "No existen pedidos para este cliente.";

    } else {

        // SI TIENE PEDIDOS, LOS MOSTRAMOS
        echo "<h3>Tus pedidos:</h3>";

        // VARIABLE PARA IR SUMANDO LOS PRECIOS
        $total = 0;

        // RECORREMOS EL ARRAY DE OBJETOS PEDIDO
        foreach ($pedidos as $pedido) {

            echo "<p>Producto: " . $pedido->producto .
                 " - Precio: " . $pedido->precio . " €</p>";

            // SUMAMOS EL PRECIO DEL PEDIDO AL TOTAL
            $total = $total + $pedido->precio;
        }

        // MOSTRAMOS EL IMPORTE TOTAL
        echo "<h3>Importe total: " . $total . " €</h3>";

    }

    ?>
    <a href="acceso.html">Volver al acceso</a>
</body>
</html>
