<?php
$mensaje="";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario=$_POST['usuario'];
    $correo=$_POST['correo'];
    $contraseña=$_POST['contraseña'];
    $contraseña_confirmar=$_POST['contraseña_confirmar'];

    if(empty($usuario) || empty($contraseña) || empty($correo) || empty($contraseña_confirmar)){
        $mensaje="Error : Todos los campos deben estra completos";
    }else if($contraseña != $contraseña_confirmar){
        $mensaje="Error: Las contraseñas introducidas no coinciden";
    }else if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){ //valida si el formato es bueno
       $mensaje="Error: El correo no tiene un formato valido";
    }else if(strlen($contraseña)< 8){ //cuenta cuantos caracteres tiene
        $mensaje="Error :La contraseña debe tener al menos 8 caracteres";
    }else if(!preg_match('/[A-Z]/',$contraseña) || !preg_match('/[a-z]/',$contraseña)){
      $mensaje="Error: la contrasela debe contener al menos una mayuscula y minuscula.";
    }else if(!preg_match('/[0-9]/',$contraseña)){
        $mensaje="Error :la contraseña debe contener al menos un numero";
    }else if(!preg_match('/[^A-Za-z0-9]/', $contraseña)){
       $mensaje ="La contraseña debe contener algun caratcter especial";
    }else{
        $mensaje="Bienvenido";
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
    <form action="" method="POST">
      <label>Usuario</label>
      <input type="text" name="usuario"> <br><br>

      <label>Correo electronico</label>
      <input type="email" name="correo"> <br><br>

      <label>Contraseña</label>
      <input type="password" name="contraseña">  <br><br>

      <label>Repite la contraseña</label>
      <input type="password" name="contraseña_confirmar"> <br><br>

      <button type="submit">Enviar</button>


    </form>

    <?php if($mensaje !=""):?>
      <br>
      <p><?php echo $mensaje; ?></p>
      
        <?php endif; ?>
</body>
</html>