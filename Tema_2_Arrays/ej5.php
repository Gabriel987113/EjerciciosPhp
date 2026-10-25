<?php


$nums=[];
$contador=0;

while($contador<6){
    $numero=rand(1,49);
    
    if(!in_array($numero, $nums)){
        $nums[] = $numero;
        $contador++;
    }
}

$complementario=$nums[5];

$ganadores=array_slice($nums,0,5);           //me modifica el array sin borrarme el original,me coge solo e
                                             //esas posicciones

sort($ganadores);         //rsort de mayor a menor

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <table>
        <tr>
          <?php 
            foreach($ganadores as $numero){
              echo "<td>$numero</td>" ; 
            }
            echo "<td>Complementario: $complementario</td>";
          ?>
        </tr>
    </table>
</body>
</html>