<?php

$nombre= $_POST['nombre'] ?? '';
$contraseña=$_POST['contraseña'] ?? '';
$color=$_POST['color'] ?? ' ';
$anuncios=$_POST['anuncios'] ?? 'NO ';
$anio=$_POST['anio_estudios'] ?? '';
$textoArea=$_POST['textoArea'] ?? '';

//2. Recoghemos los datos multiples en arrays
$idiomas=$_POST['idiomas'] ?? [];
$ciudades=$_POST['ciudades'] ??  [];

//3.Valores recibidosa en el formulario
echo" <h2>Valores recibidos en el formlario;</h2>";

echo "Nombre: " . $nombre . "<br>";
echo "Contraseña: " . $contraseña . "<br>";
echo "Color: " . $color . "<br>";
echo "Desea recibir anuncios:: " . $anuncios . "<br>";

// Con implode unimos los elementos del array 
//con una coma para que no de error
echo "Idiomas seleccionados: " . implode(", ", $idiomas) . "<br>";

echo "Año de finalizacion de estudios: " . $anio . "<br>";

echo "Ciudades seleccionadas: " . implode(", ", $ciudades) . "<br>";

echo "Comentarios: ". $textoArea . "<br>";

?>