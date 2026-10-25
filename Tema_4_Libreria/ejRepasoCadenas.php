
<?php
/*
========================================================
        FUNCIONES DE CADENAS EN PHP
========================================================


1. LONGITUD, MAYÚSCULAS, MINÚSCULAS Y ASCII
--------------------------------------------------------

// 1.1. strlen($cadena)
// Devuelve la longitud de la cadena en bytes.
// Los espacios también cuentan.
$texto = "Hola mundo";
echo strlen($texto); // 10


// 1.2. strtolower($cadena)
// Convierte toda la cadena a minúsculas.
$nombre = "MaRiA";
echo strtolower($nombre); // maria


// 1.3. strtoupper($cadena)
// Convierte toda la cadena a mayúsculas.
$nombre = "MaRiA";
echo strtoupper($nombre); // MARIA


// 1.4. ucwords($cadena)
// Pone en mayúscula la primera letra de cada palabra.
$texto = "hola mundo";
echo ucwords($texto); // Hola Mundo


// 1.5. ucfirst($cadena)
// Pone en mayúscula el primer carácter de la cadena.
$texto = "hola mundo";
echo ucfirst($texto); // Hola mundo


// 1.6. chr($numero)
// Devuelve el carácter correspondiente al código indicado.
echo chr(97); // a


// 1.7. ord($cadena)
// Devuelve el código del primer byte de la cadena.
// Para caracteres ASCII coincide con su código ASCII.
echo ord("a"); // 97


// IMPORTANTE:
// strlen() cuenta bytes.
// Para contar caracteres UTF-8, como ñ o á, usa mb_strlen().
// strtoupper(), strtolower(), ucfirst() y ucwords()
// no manejan correctamente todos los caracteres UTF-8
// en todas las configuraciones; para ello existen funciones mb_*.



2. ELIMINAR ESPACIOS
--------------------------------------------------------

// 2.1. ltrim($cadena)
// Elimina los espacios del principio.
$texto = "   Hola   ";
echo ltrim($texto); // "Hola   "


// 2.2. rtrim($cadena)
// Elimina los espacios del final.
$texto = "   Hola   ";
echo rtrim($texto); // "   Hola"


// 2.3. trim($cadena)
// Elimina los espacios del principio y del final.
$texto = "   Hola   ";
echo trim($texto); // "Hola"


// 2.4. chop($cadena)
// Es un alias de rtrim(): elimina los espacios del final.
$texto = "Hola   ";
echo chop($texto); // "Hola"


// Ejemplo práctico: comprobar si un nombre está vacío.
$nombre = "   ";
$nombre = trim($nombre);

if ($nombre == "") {
    echo "El nombre está vacío";
} else {
    echo "Nombre: " . $nombre;
}



3. EXTRAER PARTES DE UNA CADENA: substr()
--------------------------------------------------------

// 3.1. substr($cadena, $inicio)
// Extrae desde la posición indicada hasta el final.
// Las posiciones empiezan en 0.
$texto = "Hola mundo";
echo substr($texto, 5); // mundo


// 3.2. substr($cadena, $inicio, $cantidad)
// Extrae el número de caracteres indicado.
$texto = "Hola mundo";
echo substr($texto, 0, 4); // Hola


// 3.3. Inicio negativo
// Cuenta desde el final de la cadena.
$texto = "Hola mundo";
echo substr($texto, -5); // mundo


// 3.4. Cantidad negativa
// Excluye caracteres del final de la cadena.
$texto = "Hola mundo";
echo substr($texto, 0, -6); // Hola


// 3.5. Inicio y cantidad negativos
$texto = "Hola mundo";
echo substr($texto, -5, -1); // mund


// Ejemplo práctico: comprobar el prefijo de un código.
$codigo = "ABC123";

if (substr($codigo, 0, 3) == "ABC") {
    echo "El código empieza por ABC";
} else {
    echo "El prefijo no es correcto";
}



4. MODIFICAR CADENAS
--------------------------------------------------------

// 4.1. strrev($cadena)
// Invierte el orden de los caracteres.
$texto = "Hola";
echo strrev($texto); // aloH


// 4.2. str_repeat($cadena, $cantidad)
// Repite la cadena el número de veces indicado.
$texto = "Ja";
echo str_repeat($texto, 3); // JaJaJa


// 4.3. str_pad($cadena, $longitud, $relleno, $tipo)
// Añade caracteres hasta alcanzar la longitud indicada.
//
// STR_PAD_RIGHT -> rellena por la derecha.
// STR_PAD_LEFT  -> rellena por la izquierda.
// STR_PAD_BOTH  -> rellena por ambos lados.
//
// Si se omite el relleno, utiliza espacios.
// Si se omite el tipo, rellena por la derecha.

$texto = "PHP";

echo str_pad($texto, 5, "@", STR_PAD_RIGHT); // PHP@@
echo str_pad($texto, 5, "@", STR_PAD_LEFT);  // @@PHP
echo str_pad($texto, 5, "@", STR_PAD_BOTH);  // @PHP@


// 4.4. str_replace($buscar, $sustituir, $cadena)
// Sustituye todas las apariciones de un texto por otro.
$texto = "Hola Ana";
$resultado = str_replace("Ana", "Luis", $texto);

echo $resultado; // Hola Luis


// 4.5. substr_replace($cadena, $reemplazo, $inicio, $longitud)
// Sustituye una parte de la cadena.
$texto = "Hola mundo";
$resultado = substr_replace($texto, "amigo", 5, 5);

echo $resultado; // Hola amigo


// Ejemplo práctico: sustituir una palabra si existe.
$texto = "Me gusta Java";

if (strpos($texto, "Java") !== false) {
    $texto = str_replace("Java", "PHP", $texto);
    echo $texto; // Me gusta PHP
}



5. DIVIDIR CADENAS: explode()
--------------------------------------------------------

// 5.1. explode($separador, $cadena)
// Divide una cadena y devuelve un array.
$texto = "lunes martes miércoles";
$dias = explode(" ", $texto);

echo $dias[0]; // lunes
echo $dias[1]; // martes
echo $dias[2]; // miércoles


// 5.2. Se puede utilizar cualquier separador.
$texto = "rojo-verde-azul";
$colores = explode("-", $texto);

foreach ($colores as $color) {
    echo $color . " ";
}
// rojo verde azul


// 5.3. explode($separador, $cadena, $limite)
// El límite indica el número máximo de partes.
// La última parte contiene el resto de la cadena.
$texto = "Ana-Luis-Marta";
$nombres = explode("-", $texto, 2);

echo $nombres[0]; // Ana
echo $nombres[1]; // Luis-Marta


// Ejemplo práctico: comprobar si un nombre está en la lista.
$texto = "Ana-Luis-Marta";
$nombres = explode("-", $texto);

if (in_array("Luis", $nombres)) {
    echo "Luis está en la lista";
} else {
    echo "Luis no está en la lista";
}



6. UNIR ARRAYS EN UNA CADENA: implode()
--------------------------------------------------------

// 6.1. implode($separador, $array)
// Une los elementos del array en una cadena.
$nombres = ["Ana", "Luis", "Marta"];
$texto = implode(" - ", $nombres);

echo $texto; // Ana - Luis - Marta


// Ejemplo utilizando explode() e implode().
$texto = "rojo-verde-azul";
$colores = explode("-", $texto);

$resultado = implode(", ", $colores);
echo $resultado; // rojo, verde, azul


// Ejemplo práctico.
$numeros = [10, 20, 30];

if (count($numeros) > 0) {
    echo implode(" + ", $numeros); // 10 + 20 + 30
}



7. INTERPRETAR PARÁMETROS: parse_str()
--------------------------------------------------------

// 7.1. parse_str($cadena, $resultado)
// Interpreta una cadena con formato de parámetros
// y guarda los datos en un array asociativo.
$texto = "pagina=1&seccion=2";

parse_str($texto, $datos);

echo $datos["pagina"];  // 1
echo $datos["seccion"]; // 2


// Ejemplo práctico: comprobar si existe un parámetro.
$texto = "pagina=1&seccion=2";
parse_str($texto, $datos);

if (isset($datos["pagina"])) {
    echo "La página es " . $datos["pagina"];
} else {
    echo "No se ha indicado la página";
}



// 8. BUSCAR TEXTO: strpos()
--------------------------------------------------------

// 8.1. strpos($cadena, $buscado)
// Devuelve la posición de la primera aparición.
// Si no lo encuentra, devuelve false.
// Las posiciones empiezan en 0.
$texto = "Hola mundo";
$posicion = strpos($texto, "mundo");

if ($posicion !== false) {
    echo "Encontrado en la posición " . $posicion;
} else {
    echo "Texto no encontrado";
}
// Posición 5


// IMPORTANTE:
// Utiliza !== false.
// Una coincidencia al principio devuelve 0, no false.
$texto = "Hola mundo";
$posicion = strpos($texto, "Hola");

if ($posicion !== false) {
    echo "Encontrado al principio";
} else {
    echo "No encontrado";
}



// 9. BUSCAR UNA PARTE DE LA CADENA: strstr()
--------------------------------------------------------

// 9.1. strstr($cadena, $buscado)
// Devuelve la cadena desde la primera coincidencia.
$email = "ana@gmail.com";
$dominio = strstr($email, "@");

echo $dominio; // @gmail.com


// 9.2. strstr($cadena, $buscado, true)
// Si el tercer argumento es true, devuelve la parte anterior.
$email = "ana@gmail.com";
$usuario = strstr($email, "@", true);

echo $usuario; // ana


// Ejemplo práctico.
$email = "ana@gmail.com";

if (strstr($email, "@") !== false) {
    echo "El correo contiene una arroba";
} else {
    echo "Falta la arroba";
}



// 10. CONTAR APARICIONES: substr_count()
--------------------------------------------------------

// 10.1. substr_count($cadena, $buscado)
// Cuenta las apariciones de un texto.
// Distingue mayúsculas de minúsculas.
$texto = "hola hola adios";
$total = substr_count($texto, "hola");

echo "Aparece " . $total . " veces"; // 2


// 10.2. substr_count($cadena, $buscado, $inicio)
// Empieza a buscar desde la posición indicada.
$texto = "hola hola adios";
$total = substr_count($texto, "hola", 5);

echo $total; // 1


// 10.3. substr_count($cadena, $buscado, $inicio, $longitud)
// Limita la búsqueda a una parte de la cadena.
$texto = "hola hola adios";
$total = substr_count($texto, "hola", 0, 4);

echo $total; // 1


// Ejemplo práctico.
$texto = "PHP es fácil. PHP es útil.";

if (substr_count($texto, "PHP") >= 2) {
    echo "PHP aparece al menos dos veces";
} else {
    echo "PHP aparece menos de dos veces";
}



// 11. CONTAR CARACTERES: count_chars()
--------------------------------------------------------

// 11.1. count_chars($cadena, 0)
// Devuelve un array con la frecuencia de cada carácter.
// El índice corresponde al código del carácter.
$texto = "banana";
$frecuencias = count_chars($texto, 0);

$totalA = $frecuencias[ord("a")];

echo "La letra a aparece " . $totalA . " veces"; // 3


// Ejemplo práctico.
$texto = "banana";
$frecuencias = count_chars($texto, 0);

if ($frecuencias[ord("n")] > 0) {
    echo "La letra n aparece en el texto";
} else {
    echo "La letra n no aparece";
}



// 12. CARACTERES ESPECIALES DE HTML
--------------------------------------------------------

// 12.1. htmlspecialchars($cadena)
// Convierte caracteres especiales en entidades HTML.
// Es útil para mostrar texto sin que se interprete como HTML.
$texto = "<h1>Hola</h1>";

echo htmlspecialchars($texto, ENT_QUOTES, "UTF-8");
// Muestra las etiquetas como texto, no como un título.


// Ejemplo con texto introducido por un usuario.
$nombre = "<script>alert('Hola')</script>";

echo htmlspecialchars($nombre, ENT_QUOTES, "UTF-8");
// Evita que el navegador interprete ese contenido como HTML.


// 12.2. htmlspecialchars_decode($cadena)
// Convierte entidades HTML en caracteres originales.
$texto = "&lt;strong&gt;HOLA&lt;/strong&gt;";

$resultado = htmlspecialchars_decode($texto);

echo $resultado; // <strong>HOLA</strong>


// Ejemplo práctico.
$texto = "&lt;b&gt;Hola&lt;/b&gt;";

if (strpos($texto, "&lt;") !== false) {
    $texto = htmlspecialchars_decode($texto);
    echo $texto;
}


// IMPORTANTE:
// htmlspecialchars_decode() no hace seguro el contenido.
// Si vuelves a mostrar datos no confiables en HTML,
// debes escaparlos con htmlspecialchars() al mostrarlos.



/*
========================================================
RESUMEN RÁPIDO
========================================================

strlen()                   -> longitud en bytes.
strtolower()               -> minúsculas.
strtoupper()               -> mayúsculas.
ucwords()                  -> inicial de cada palabra en mayúscula.
ucfirst()                  -> inicial de la cadena en mayúscula.
chr()                      -> código numérico a carácter.
ord()                      -> primer byte a código numérico.

ltrim()                    -> elimina espacios iniciales.
rtrim() / chop()           -> elimina espacios finales.
trim()                     -> elimina espacios en ambos extremos.

substr()                   -> extrae una parte.
strrev()                   -> invierte una cadena.
str_repeat()               -> repite una cadena.
str_pad()                  -> rellena hasta una longitud.
str_replace()              -> sustituye texto.
substr_replace()           -> sustituye una parte.

explode()                  -> cadena a array.
implode()                  -> array a cadena.
parse_str()                -> interpreta parámetros.

strpos()                   -> devuelve la posición de una coincidencia.
strstr()                   -> devuelve parte de la cadena.
substr_count()             -> cuenta apariciones de un texto.
count_chars()              -> cuenta frecuencias de caracteres.

htmlspecialchars()         -> escapa caracteres HTML.
htmlspecialchars_decode()  -> decodifica entidades HTML.

IMPORTANTE:
strpos() puede devolver 0 si encuentra el texto al principio.
Por eso se comprueba con !== false.

strlen() cuenta bytes; para contar caracteres UTF-8
puede utilizarse mb_strlen().
*/
?>