<?php
// pagocookie.php = archivo que ejecutamos
// ? = indica que enviamos datos
// nuevatarjeta = nombre del dato
// visa1 = valor del dato
// $_GET["nuevatarjeta"] = recoge el valor enviado

/*
URL
nuevatarjeta = visa1                                      
       ↓
$_GET["nuevatarjeta"]
       ↓
setcookie()
       ↓
COOKIE
tarjeta = visa1

$_GET    → recoge datos de la URL
$_COOKIE → recoge datos guardados en cookies
------------------------------------------------------------------------
1. Entras por primera vez
   ↓
No hay tarjeta guardada

2. Pulsas VISA
   ↓
URL: pagocookie.php?nuevatarjeta=visa1
   ↓
$_GET["nuevatarjeta"] → "visa1"
   ↓
setcookie("tarjeta", "visa1")
   ↓
La cookie queda guardada

3. Sales de la página

4. Vuelves a entrar
   ↓
pagocookie.php
   ↓
Ya no viene "nuevatarjeta" en la URL
   ↓
Pero existe la cookie "tarjeta"
   ↓
$_COOKIE["tarjeta"] → "visa1"
   ↓
Mostramos VISA
*/

if(isset($_GET["nuevatarjeta"])){
 setcookie("tarjeta", $_GET["nuevatarjeta"]);
}

if (isset($_COOKIE["tarjeta"])) { 
    // ¿Existe la cookie llamada tarjeta?
    // Si existe, por ejemplo: tarjeta = visa

    echo "<img src='img/" . $_COOKIE["tarjeta"] . ".png'>";
} else {
    echo "No tiene forma de pago asignada";
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Forma de pago</title>
</head>

<body>

<center>

    <h2>SU FORMA DE PAGO ACTUAL ES</h2>

    <h2>SELECCIONE UNA NUEVA TARJETA DE CREDITO</h2>

    <a href="pagocookie.php?nuevatarjeta=cashu">
        <img src="img/cashu.png">
    </a>

    <a href="pagocookie.php?nuevatarjeta=cirrus1">
        <img src="img/cirrus1.png">
    </a>

    <a href="pagocookie.php?nuevatarjeta=dinersclub">
        <img src="img/dinersclub.png">
    </a>

    <a href="pagocookie.php?nuevatarjeta=mastercard">
        <img src="img/mastercard.png">
    </a>

    <a href="pagocookie.php?nuevatarjeta=paypal">
        <img src="img/paypal.png">
    </a>

    <a href="pagocookie.php?nuevatarjeta=visa">
        <img src="img/visa.png">
    </a>

    <a href="pagocookie.php?nuevatarjeta=visa_electron">
        <img src="img/visa_electron.png">
    </a>

</center>

</body>
</html>