<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){

$nombre=$_POST['nombre'];
$apellidos=$_POST['apellidos'];
$edad=$_POST['edad'];
$sexo=$_POST['genero'];
$hobbies = [];    //para crear un array

if(isset($_POST['hobbies'])){
    $hobbies = $_POST['hobbies'];
}

mostrarMensaje($nombre,$apellidos,$edad,$sexo,$hobbies);
}

function siEsMayorDe55($edad,$sexo){ 
$resultado="";
if($edad == "masDe55"){
    if($sexo=="hombre"){
      $resultado="Bienvenido D. ";
    }else{
      $resultado="Bienvenida Dña. ";
    }
}else{
    if($sexo == "hombre"){
        $resultado="Bienvenido";
    }else{
        $resultado="Bienvenida";
    }
}
return $resultado;
}

function tieneHobbies($hobbies){
$resultado="";
   if(empty($hobbies)){
    $resultado="No tiene afciciones de nuestra lista";
    return $resultado;
   }

   $totalHobbies=count($hobbies);

   if($totalHobbies==1){
    $resultado="Su unica aficion es: " . $hobbies[0];
   }else{
    $ultimoHobbie=array_pop($hobbies);
    $resto=implode(", ", $hobbies);

    $resultado="Sus afciones son " . $resto . " y " . $ultimoHobbie;
   }

   return $resultado;
}

function mostrarMensaje($nombre,$apellidos,$edad,$sexo,$hobbies){

$tratamiento=siEsMayorDe55($edad,$sexo);
$losHobbies=tieneHobbies($hobbies);

echo "<p>" . $tratamiento . " "  . $nombre . "  " . $apellidos . " " . $losHobbies .  "</p>";
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
    <form method="post">
      
      <label>Nombre: </label>
      <input type="text" name="nombre"> <br><br>

      <label>Apellidos</label>
      <input type="text" name="apellidos"> <br><br>

      <label>Edad</label>
      <select name="edad">
        <option value="menos-18">Menor de 18</option>
        <option value="18-55">Entre 18 y 55</option>
        <option value="masDe55">Mas de 55</option>
      </select> <br><br>

      <label>Sexo: </label>
      <label>
      <input type="radio" name="genero" value="hombre"> Hombre
      </label>

      <label>
      <input type="radio" name="genero" value="mujer"> Mujer
      </label> <br><br>

      <label>Hobbies:</label>   <br><br>
      <input type="checkbox" name="hobbies[]" value="lectura" checked>Lectura <br>
      <input type="checkbox" name="hobbies[]" value="tele">Ver la tele <br>

      <input type="checkbox" name="hobbies[]" value="deporte">Hacer deporte <br>
      <input type="checkbox" name="hobbies[]" value="marcha">Salir de marcha <br>

      <br>
      <button type="submit">Enviar</button>
      <br><br>
    </form>
</body>
</html>