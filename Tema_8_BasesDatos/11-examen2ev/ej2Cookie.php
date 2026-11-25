
<?php
/*
EJERCICIO 2:
Realiza una página PHP que recuerde el idioma elegido por
el usuario mediante una cookie llamada "idioma".

- Si no existe la cookie, se muestra un mensaje indicando
  que no ha seleccionado ningún idioma.
- Se crea un formulario GET para elegir Español, Inglés o Francés.
- Al enviar el formulario, se guarda el idioma durante 7 días.
- Si existe la cookie, se muestra el idioma seleccionado.
- Mediante un botón "Borrar preferencia" se elimina la cookie.
*/

// COMPROBAMOS SI SE HA ENVIADO UN IDIOMA
if (isset($_GET["idioma"])) {

    // GUARDAMOS EL IDIOMA DURANTE 7 DIAS
    $idioma = $_GET["idioma"];
    setcookie("idioma", $idioma, time() + 604800);

    

} else {

    // COMPROBAMOS SI EXISTE LA COOKIE
    if (isset($_COOKIE["idioma"])) {
        $idioma = $_COOKIE["idioma"];
    } else {
        $idioma = "";
    }
}

// COMPROBAMOS SI SE HA PULSADO BORRAR
if (isset($_GET["accion"]) && $_GET["accion"] == "Borrar") {

    // ELIMINAMOS LA COOKIE
    setcookie("idioma", "", time() - 3600);

    $idioma = "";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preferencia de idioma</title>
</head>
<body>

    <h2>Selecciona tu idioma</h2>

    <?php
    if ($idioma == "") {
        echo "No has seleccionado ningún idioma";
    } else {
        echo "Tu idioma seleccionado es: " . $idioma;
    }
    ?>

    <br><br>

    <form method="GET" action="idioma.php">

        <select name="idioma">
            <option value="Español">Español</option>
            <option value="Inglés">Inglés</option>
            <option value="Francés">Francés</option>
        </select>

        <input type="submit" value="Guardar idioma">

    </form>

    <br>

    <form method="GET" action="idioma.php">
        <input type="submit" name="accion" value="Borrar">
    </form>

</body>
</html>
