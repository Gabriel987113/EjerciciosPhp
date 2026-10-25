<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){

$nombre=$_POST['nombre'];
$apellido=$_POST['apellidos'];
$edad=$_POST['edad'];
$sexo=$_POST['genero'];
$hobbies = [];

if (isset($_POST['hobbies'])) {
    $hobbies = $_POST['hobbies'];
}

mostrarMensaje($nombre, $apellido, $edad, $sexo, $hobbies);
}

function siTieneMas55($edad,$sexo){
  $resultado=""; 
  if($edad == "masDe55"){
    if($sexo=="mujer"){
      $resultado="Dña";
    }else{
      $resultado="D. ";
    }
  }
  return $resultado;
}


  function siTieneHobbies($hobbies){
    //CASO 1
    if (empty($hobbies)){
      return "no tiene aficiones de nuestra lista";
    }

    //CASO 2
    $total=count($hobbies);

    if($total==1){
      return "su unica aficion es " . $hobbies[0];
    }else{
    
      $ultimo=array_pop($hobbies);//Guarda el último elemento que extrae.

        //Elimina ese elemento del array original.

      $resto=implode(", ", $hobbies);

      return "sus aficiones son " . $resto . " y " . $ultimo . ".";
    }
  }


  function mostrarMensaje($nombre,$apellido,$edad,$genero,$hobbies){

  $bienvenida="";
  if($genero == "mujer"){
    $bienvenida="Bienvenida";
  }else{
    $bienvenida="Bienvenido";
  }

  $tratamiento=siTieneMas55($edad,$genero);

  $textoHobbies=siTieneHobbies($hobbies);

  echo "<p>" . $bienvenida . " " . $tratamiento . " " . $nombre . " " . 
   $apellido . " " . $textoHobbies . "</p>" ;
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