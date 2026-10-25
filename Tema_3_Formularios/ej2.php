<?php

$resultadoMostrar = 0;
$formato = "decimal";
$error = false;
$resultado = 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $formato = $_POST["formato"];
    $numero1 = $_POST["primerNumero"];
    $numero2 = $_POST["segundoNumero"];
    $operacion = $_POST["operacion"];

    // Calculamos la operacion
    switch ($operacion) {

        case "suma":
            $resultado = $numero1 + $numero2;
            break;

        case "resta":
            $resultado = $numero1 - $numero2;
            break;

        case "multiplicacion":
            $resultado = $numero1 * $numero2;
            break;

        case "division":
            if ($numero2 == 0) {
                echo "No se puede dividir entre 0";
                $error = true;
            } else {
                $resultado = $numero1 / $numero2;
            }
            break;
    }

    // Mostramos el resultado en el formato elegido
    if (!$error) {
        switch ($formato) {

            case "decimal":
                $resultadoMostrar = $resultado;
                break;

            case "binario":
                $resultadoMostrar = decbin($resultado);
                break;

            case "hexadecimal":
                $resultadoMostrar = dechex($resultado);
                break;
        }
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
    <h2>Mini Calculadora</h2><br><br>
     
<form action="" method="post">
    <label>Nº1</label>
    <input type="number" name="primerNumero">
    
    <br><br>
    
    <label>Nº2</label>
    <input type="number" name="segundoNumero">

    <br><br>
<fieldset>
    <button type="submit" name="operacion" value="suma">+</button>
    <button type="submit" name="operacion" value="resta">-</button>
    <button type="submit" name="operacion" value="multiplicacion">*</button>
    <button type="submit" name="operacion" value="division">/</button>
</fieldset>

<br><br>

<fieldset>

<input type="radio" name="formato" value="decimal" checked>
<label>Decimal</label>

<input type="radio" name="formato" value="binario">
<label>Binario</label>

<input type="radio" name="formato" value="hexadecimal">
<label>Hexadecimal</label>
</fieldset>

<br><br>
<button type="reset">Resetear</button>

</form>

<br><br>

<h3>Resultado: <?php echo $resultadoMostrar?></h3>
</body>
</html>