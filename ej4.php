<?php


$deportes= [
   "Futbol" => "img/sports-football.svg",
   "Basketball" => "img/sports-basketball.svg",
   "Voleyball" => "img/sports-volleyball-solid.svg",
   "Tenis" => "img/sports-tennis-solid.svg"
];


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table border="solid">
        <thead>
        <th>
            Deporte
        </th>
        <th>
            Logo
        </th>
        </thead>
        <tbody>
            <?php foreach($deportes as $nombre => $imagen){
               echo "<tr>";
               echo "<td>$nombre</td>";

               echo "<td><img src='$imagen' width='100'></td>";
               echo "</tr>";
             }
            ?>
        </tbody>
    </table>
</body>
</html>