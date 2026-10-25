    <?php

    $numeros = [];

    for($i=0; $i<20; $i++){
        $numeros[]=rand(1,10);
    }

    function obtenerMax($array){
 
     $max=$array[0];

     foreach($array as $numero){
        if($numero>$max){
            $max=$numero;
        }
     }

     return $max;
    }

    function obtenerMin($array){
        $min=$array[0];

        foreach($array as $num){
            if($num<$min){
                $min=$num;
            }
        }

        return $min;
    }

    function obtenerMasRepetido($array){
        $masRepetido=$array[0];
        $contadorMasVeces=0;

        foreach($array as $numero){
            $cantidad=0;

            foreach($array as $valor){
                if($numero==$valor){
                    $cantidad++;
                }
            }

              if($cantidad>$contadorMasVeces){
            $contadorMasVeces=$cantidad;
            $masRepetido=$numero;
        }

        }

        return $masRepetido;
    }


    $maximo=obtenerMax($numeros);
    $minimo=obtenerMin($numeros);
    $masRepetido=obtenerMasRepetido($numeros);
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
            foreach($numeros as $numero){
                echo "<td>$numero</td>";
            }
             ?>
        </tr>
    </table>
    <p>Valor maximo: <?php echo $maximo    ?></p>
    <p>Valor minimo: <?php echo $minimo   ?></p>
    <p>Valor mas repetido: <?php echo $masRepetido?></p>
</body>
</html>