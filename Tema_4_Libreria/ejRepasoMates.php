
<?php
/*
1. REDONDEOS, POTENCIAS, RAÍCES Y LOGARITMOS

    1.1. abs($numero)
         Devuelve el valor absoluto: elimina el signo negativo.
         Ejemplo:
         $numero = -6.34;
         echo abs($numero); // 6.34

    1.2. ceil($numero)
         Redondea hacia arriba al entero inmediatamente superior.
         Ejemplo:
         $numero = 3.54;
         echo ceil($numero); // 4

    1.3. floor($numero)
         Redondea hacia abajo al entero inmediatamente inferior.
         Ejemplo:
         $numero = 3.54;
         echo floor($numero); // 3

    1.4. round($numero)
         Redondea al entero más próximo.
         Ejemplo:
         $numero = 3.54;
         echo round($numero); // 4

         Otro ejemplo:
         $numero = 3.24;
         echo round($numero); // 3

    1.5. pow($base, $exponente)
         Calcula una potencia: base elevada al exponente.
         Ejemplo:
         $base = 2;
         $exponente = 4;
         echo pow($base, $exponente); // 16

    1.6. sqrt($numero)
         Calcula la raíz cuadrada de un número.
         Ejemplo:
         $numero = 25;
         echo sqrt($numero); // 5

    1.7. log($numero)
         Calcula el logaritmo natural (base e).
         Ejemplo:
         $numero = exp(1);
         echo log($numero); // 1 aproximadamente

    1.8. log10($numero)
         Calcula el logaritmo en base 10.
         Ejemplo:
         $numero = 100;
         echo log10($numero); // 2


2. CONVERSIÓN ENTRE BASES NUMÉRICAS

    Bases más habituales:
    Base 2  -> binario: 0 y 1.
    Base 8  -> octal: del 0 al 7.
    Base 10 -> decimal: del 0 al 9.
    Base 16 -> hexadecimal: del 0 al 9 y letras A-F.

    2.1. decoct($numero)
         Convierte un número decimal a base 8 (octal).
         Ejemplo:
         $numero = 10;
         echo decoct($numero); // 12

    2.2. dechex($numero)
         Convierte un número decimal a base 16 (hexadecimal).
         Ejemplo:
         $numero = 255;
         echo dechex($numero); // ff

    2.3. decbin($numero)
         Convierte un número decimal a base 2 (binario).
         Ejemplo:
         $numero = 10;
         echo decbin($numero); // 1010

    2.4. octdec($numero)
         Convierte un número octal a decimal.
         Ejemplo:
         $numero = "17";
         echo octdec($numero); // 15

    2.5. hexdec($numero)
         Convierte un número hexadecimal a decimal.
         Ejemplo:
         $numero = "FF";
         echo hexdec($numero); // 255

    2.6. bindec($numero)
         Convierte un número binario a decimal.
         Ejemplo:
         $numero = "1010";
         echo bindec($numero); // 10

    2.7. base_convert($numero, $base_origen, $base_destino)
         Convierte un número de una base a otra.
         Ejemplo:
         $numero = "1010";
         echo base_convert($numero, 2, 10); // 10

         IMPORTANTE:
         base_convert() devuelve una cadena de texto.


3. NÚMEROS ALEATORIOS

    3.1. rand($minimo, $maximo)
         Genera un número entero aleatorio entre ambos límites.
         Ejemplo:
         $numero = rand(1, 10);
         echo $numero;

         if ($numero >= 1 && $numero <= 10) {
             echo " Está dentro del rango";
         }

    3.2. getrandmax()
         Devuelve el valor máximo que puede generar rand()
         cuando no se indican límites.
         Ejemplo:
         echo getrandmax();

    3.3. mt_rand($minimo, $maximo)
         Genera un número entero aleatorio.
         Ejemplo:
         $numero = mt_rand(100, 1000);
         echo $numero;

    3.4. mt_getrandmax()
         Devuelve el valor máximo que puede generar mt_rand()
         cuando no se indican límites.
         Ejemplo:
         echo mt_getrandmax();

    IMPORTANTE:
    Para contraseñas, tokens y otros datos de seguridad,
    es preferible utilizar random_int().


4. FUNCIONES TRIGONOMÉTRICAS

    IMPORTANTE:
    sin(), cos() y tan() trabajan con RADIANES, no con grados.

    4.1. sin($angulo)
         Calcula el seno del ángulo en radianes.
         Ejemplo:
         $angulo = deg2rad(90);
         echo round(sin($angulo), 2); // 1

    4.2. cos($angulo)
         Calcula el coseno del ángulo en radianes.
         Ejemplo:
         $angulo = deg2rad(60);
         echo round(cos($angulo), 2); // 0.5

    4.3. tan($angulo)
         Calcula la tangente del ángulo en radianes.
         Ejemplo:
         $angulo = deg2rad(45);
         echo round(tan($angulo), 2); // 1

    4.4. asin($valor)
         Devuelve el arco seno: el ángulo cuyo seno es ese valor.
         El resultado está en radianes.
         Ejemplo:
         $angulo = asin(1);
         echo rad2deg($angulo); // 90 grados

    4.5. acos($valor)
         Devuelve el arco coseno en radianes.
         Ejemplo:
         $angulo = acos(1);
         echo rad2deg($angulo); // 0 grados

    4.6. atan($valor)
         Devuelve el arco tangente en radianes.
         Ejemplo:
         $angulo = atan(1);
         echo round(rad2deg($angulo)); // 45 grados

    4.7. deg2rad($grados)
         Convierte grados a radianes.
         Ejemplo:
         $grados = 180;
         echo deg2rad($grados); // PI aproximadamente

    4.8. rad2deg($radianes)
         Convierte radianes a grados.
         Ejemplo:
         $radianes = pi();
         echo rad2deg($radianes); // 180

    4.9. pi()
         Devuelve el valor del número PI.
         Ejemplo:
         echo pi(); // 3.141592...


5. PRESENTACIÓN DE NÚMEROS

    5.1. number_format($numero)
         Formatea un número sin decimales por defecto,
         utilizando coma para los miles.
         Ejemplo:
         $numero = 1234.56;
         echo number_format($numero); // 1,235

    5.2. number_format($numero, $decimales)
         Indica cuántos decimales mostrar.
         Por defecto, usa punto decimal y coma para los miles.
         Ejemplo:
         $numero = 1234.5;
         echo number_format($numero, 2); // 1,234.50

    5.3. number_format($numero, $decimales,
                       $separador_decimal, $separador_miles)
         Permite elegir los separadores.
         Ejemplo:
         $precio = 1234567.896;
         echo number_format($precio, 2, ',', '.');
         // 1.234.567,90

         Otro ejemplo:
         $precio = 1234567.896;
         echo number_format($precio, 3, ',', '.');
         // 1.234.567,896

         IMPORTANTE:
         number_format() devuelve texto formateado, no un número
         pensado para seguir haciendo operaciones matemáticas.


6. OTRAS FUNCIONES NUMÉRICAS

    6.1. max($array)
         Devuelve el número mayor de un array.
         Ejemplo:
         $numeros = [10, 25, 4, 18];
         $mayor = max($numeros);

         echo "El mayor es: " . $mayor;

         if ($mayor > 20) {
             echo " Es mayor que 20";
         }

    6.2. min($array)
         Devuelve el número menor de un array.
         Ejemplo:
         $numeros = [10, 25, 4, 18];
         $menor = min($numeros);

         echo "El menor es: " . $menor;

         if ($menor < 5) {
             echo " Es menor que 5";
         }
*/
?>