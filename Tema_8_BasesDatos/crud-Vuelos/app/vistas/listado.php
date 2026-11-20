<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Listado de vuelos</title>
</head>

<body>

    <h1>Vuelos disponibles para <?php echo $destino; ?></h1>

    <table border="1">

        <thead>
            <tr>
                <th>Aerolínea</th>
                <th>Clase</th>
                <th>Precio</th>
                <th>Estado</th>
                <th>Acción</th>
            </tr>
        </thead>

        <tbody>

            <?php

            foreach ($vuelos as $vuelo) {

                echo "<tr>";

                echo "<td>" . $vuelo->aerolinea . "</td>";

                echo "<td>" . verClase($vuelo->clase) . "</td>";

                echo "<td>" . $vuelo->precio_billete . "€</td>";

                echo "<td>" . verEstado($vuelo->asientos_libres) . "</td>";

                echo "<td><a href='#'>RESERVAR</a></td>";

                echo "</tr>";
            }

            ?>

        </tbody>

    </table>

    <br>

    <a href="../index.php">Volver al inicio</a>

</body>
</html>