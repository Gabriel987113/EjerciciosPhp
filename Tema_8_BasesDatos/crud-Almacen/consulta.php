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

                <input type="submit" name="orden" value="ACTUALIZAR">

            </form>

        </div>

    </div>

</body>

</html>