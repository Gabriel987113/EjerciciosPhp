<?php
/*
Usuario pulsa VISA
       ↓
nuevatarjeta = visa
       ↓
$_GET["nuevatarjeta"] → visa
       ↓
$_SESSION["tarjeta"] = visa
       ↓
se guarda en la sesión
       ↓
$_SESSION["tarjeta"] → visa
       ↓
img/visa.png
*/
session_start();

if(isset($_GET["nuevatarjeta"])){
$_SESSION["tarjeta"] = $_GET["nuevatarjeta"]; //guarda la tarjeta que llega por la URL.
//si el usuario pulsa visa ,esto $_SESSION["tarjeta"] = $_GET["nuevatarjeta"]; guarda 
//tarjeta=visa.
}

//Comprobar si ya tenemos una tarjeta guardada en la sesión.
if(isset($_SESSION["tarjeta"])){
echo "<img src='img/" . $_SESSION["tarjeta"] . ".png'>";
}else{
    echo"No tiene forma de pago asignada";
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

    <a href="pagosesion.php?nuevatarjeta=cashu">
        <img src="img/cashu.png">
    </a>

    <a href="pagosesion.php?nuevatarjeta=cirrus1">
        <img src="img/cirrus1.png">
    </a>

    <a href="pagosesion.php?nuevatarjeta=dinersclub">
        <img src="img/dinersclub.png">
    </a>

    <a href="pagosesion.php?nuevatarjeta=mastercard">
        <img src="img/mastercard.png">
    </a>

    <a href="pagosesion.php?nuevatarjeta=paypal">
        <img src="img/paypal.png">
    </a>

    <a href="pagosesion.php?nuevatarjeta=visa">
        <img src="img/visa.png">
    </a>

    <a href="pagosesion.php?nuevatarjeta=visa_electron">
        <img src="img/visa_electron.png">
    </a>

</center>

</body>
</html>