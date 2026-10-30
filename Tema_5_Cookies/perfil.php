<?php
   //EDAD
    $edad="";
    if(isset($_COOKIE["edad"])){
        $edad=$_COOKIE["edad"];
    }

    //GENERO
    $genero="";
    if(isset($_COOKIE["genero"])){
        $genero=$_COOKIE["genero"];
    }

    //DEPORTES
    $deportes = [];
    if(isset($_COOKIE["deportes"])){
        $deportes=explode(",", $_COOKIE["deportes"]);
        //explode convierte el texto de la cookie en un array, 
        //separando los deportes por las comas.
    }

   //COMPRUEBA SI SE HA ENVIADO EL FORMULARIO CON EL BOTON AÑADIR VALOR
   if(isset($_POST["orden"])){ //comprueba si se ha enviado el dato del botón.
    if($_POST["orden"] == "Confirmar"){//comprueba si se ha pulsado el botón de almacenar.
       setcookie("edad", $_POST["edad"], time() + 7 * 24 * 60 * 60 );
       setcookie("genero", $_POST["genero"], time() + 7 * 24 * 60 * 60);
       setcookie("deportes", implode(",", $_POST["deportes"]), time() + 7 * 24 * 60 * 60);

       header("Location: perfil.php");
       exit();
    }

    //BORRAR LAS COOKIES
    if($_POST["orden"] == "Eliminar"){
      setcookie("edad","", time() - 3600);
      setcookie("genero","", time() - 3600);
      setcookie("deportes","", time() - 3600);

      header("Location: perfil.php");
       exit();
    }
   }
?>

html>
<head>
<meta charset="UTF-8">
<link href="default.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="container" style="width: 380px;">
<div id="header">
     <h1>SUS DATOS ALMACENADOS</h1>
</div>

<div id="content">
<fieldset> 
<form method="post">
<label>Edad</label> <input type="number" name="edad" value="<?php echo $edad ?>" ><br> 
Género :<br>
        <label> Mujer </label>
        <input type="radio" name="genero" value="Mujer"
        <?php 
        if($genero=="Mujer"){
            echo "checked";
        }
        ?>>
        <label> Hombre</label>
        <input type="radio" name="genero" value="Hombre"
        <?php
        if($genero=="Hombre"){
            echo "checked";
        }
        ?>>
        <br>
<label>Deportes</label><br>
        <select name="deportes[]" multiple="multiple" size="3">
<!--Futbol -->
     <option value="Futbol"<?php 
     if(in_array("Futbol", $deportes)){
        echo "selected";
     }
     ?>>Futbol</option> 

<!--Tenis -->
     <option value="Tenis" <?php 
     if(in_array("Tenis", $deportes)){
      echo "selected";
     }
     ?>>Tenis</option>

<!--Ciclismo -->
     <option value="Ciclismo" <?php 
     if(in_array("Ciclismo", $deportes)){
        echo "selected";
     }
     ?>>Ciclismo</option>

<!--Otro -->
     <option value="Otro" <?php 
     if(in_array("Otro", $deportes)){
        echo "selected";
     }
     ?>>Otro</option>
    </select> 
    
    <br>
    <button name="orden" value="Confirmar"> Almacenar valores </button>
    <button name="orden" value="Eliminar"> Eliminar valores </button>
</form>
</fieldset>
</div>
</div>
</body>
</html>