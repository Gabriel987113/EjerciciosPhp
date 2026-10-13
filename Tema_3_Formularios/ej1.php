<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
$usuarios = [
    "juan" => "1234",
    "ana" => "abcd",
    "luis" => "5678"
];

$correcto=false;

   foreach($usuarios as $usuario => $clave){
    if($_POST["usuario"] == $usuario && $_POST["clave"]==$clave){
         $correcto=true;
         break;
    }
   }

   if($correcto){
    echo"bienvenido " . $_POST["usuario"];
   }else{
    echo "datos incorrectos";
    echo"<br>";
    echo"<a href='ej1.html'>Volver a intentar</a>";
   }
}



?>