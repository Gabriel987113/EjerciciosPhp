<?php

$periodicos = [
    "El Pais" => "www.elpais",
    "ElMundo" => "www.elmundo",
    "ABC" => "www.abc",
    "La razon" => "www.lazara",
    "Chiringuito" => "www.chiringuito"
];

$aleatorio= array_rand($periodicos);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <ul>
        <?php foreach($periodicos as $nombre => $enlace){
           echo "<li><a href='$enlace'>$nombre</a></li>";
        } 
        ?>
    </ul>

    <p>El periodico favorito es: <?php  echo $periodicos[$aleatorio]  ?></p>
</body>
</html>