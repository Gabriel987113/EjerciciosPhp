<?php

function calcularLetraNif($numeroDNI){
    $letras=['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 
        'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];

        $resto=$numeroDNI%23;

        return $letras[$resto];
}

if($_SERVER["REQUEST_METHOD"] == "POST"){

$dni_introducido=$_POST['dni'];

if(ctype_digit($dni_introducido)){

$letraFinal=calcularLetraNif($dni_introducido);

echo "Tu dni es: " . $dni_introducido . $letraFinal;
exit;
}else{
   echo "El campò dni debe contener solo numeros";
   echo "<a href=''>Intentar de nuevo</a>";
   exit;
}
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST">
       <label for="dni">Introduce tu numero de DNI (sin letra)</label>
       <input type="text" id="dni" name="dni" pattern="[0-9]+" 
       title="Por favor,introduce solo numeros" required>
       <button type="submit">Calcular letra</button>
    </form>
</body>
</html>