<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $contraseña = $_POST['contraseña'];
    $color = "";
    $anuncios = "NO";
    $anio = $_POST['anio_estudios'];
    $textoArea = $_POST['textoArea'];

    // Comprobamos si se ha seleccionado un color
    if (isset($_POST['color'])) {
        $color = $_POST['color'];
    }

    // Comprobamos si quiere recibir anuncios
    if (isset($_POST['anuncios'])) {
        $anuncios = $_POST['anuncios'];
    }

    // Recogemos los datos multiples en arrays
    $idiomas = [];
    $ciudades = [];

    if (isset($_POST['idiomas'])) {
        $idiomas = $_POST['idiomas'];
    }

    if (isset($_POST['ciudades'])) {
        $ciudades = $_POST['ciudades'];
    }

    // Mostramos los valores recibidos
    echo "<h2>Valores recibidos en el formulario</h2>";

    echo "Nombre: " . $nombre . "<br>";
    echo "Contraseña: " . $contraseña . "<br>";
    echo "Color: " . $color . "<br>";
    echo "Desea recibir anuncios: " . $anuncios . "<br>";

    echo "Idiomas seleccionados: " . implode(", ", $idiomas) . "<br>";
    echo "Año de finalización de estudios: " . $anio . "<br>";
    echo "Ciudades seleccionadas: " . implode(", ", $ciudades) . "<br>";
    echo "Comentarios: " . $textoArea . "<br>";
}

?>