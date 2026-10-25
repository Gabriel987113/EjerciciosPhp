<?php

/*
3. COMPROBAR EL TIPO DE DATO CON is_*()

    3.1. is_string($var)
         Comprueba si la variable es una cadena de texto.
         Ejemplo:
         is_string("Hola"); // true

    3.2. is_numeric($var)
         Comprueba si el valor es numérico, aunque sea un string.
         Ejemplos:
         is_numeric("123");  // true
         is_numeric("3.14"); // true
         is_numeric("hola"); // false

    3.3. is_int($var)
         Comprueba si es un entero de tipo int REAL de PHP.
         Una cadena con números NO cuenta como entero.
         Ejemplos:
         is_int(123);   // true
         is_int("123"); // false

    3.4. is_float($var)
         Comprueba si es un número de tipo float.
         Ejemplos:
         is_float(3.14);   // true
         is_float("3.14"); // false

    3.5. is_array($var)
         Comprueba si la variable es un array.
         Ejemplo:
         is_array([1, 2, 3]); // true

    3.6. is_bool($var)
         Comprueba si la variable es un booleano (true o false).
         Ejemplo:
         is_bool(true); // true

    IMPORTANTE:
    Los datos recibidos mediante $_GET y $_POST normalmente
    llegan como strings (cadenas de texto).
    Por eso, is_int("123") devuelve false.

    DIFERENCIA CLAVE:
    is_numeric("123") -> true: contiene un valor numérico.
    is_int("123")     -> false: es un string, no un int.
    is_int(123)       -> true: es un entero real de PHP.


4. VALIDAR CADENAS DE TEXTO, FORMATOS Y LONGITUDES

    4.1. mb_strlen($texto)
         Cuenta los caracteres de una cadena, incluyendo tildes
         y eñes correctamente cuando se usa UTF-8.
         Sirve para comprobar longitudes mínimas y máximas.
         Ejemplo:
         mb_strlen("Álvaro"); // 6

         Comprobar que un nombre tiene entre 3 y 20 caracteres:
         mb_strlen($nombre) >= 3 && mb_strlen($nombre) <= 20

    4.2. preg_match($patron, $cadena)
         Comprueba si un texto cumple un patrón o formato
         definido mediante una expresión regular.
         Devuelve 1 si coincide, 0 si no coincide y false si hay error.

         Ejemplo: comprobar que un código tiene 5 dígitos:
         preg_match('/^[0-9]{5}$/', "28001"); // 1

         SIGNIFICADO DEL PATRÓN:
         ^       -> principio de la cadena.
         [0-9]   -> cualquier dígito del 0 al 9.
         {5}     -> exactamente 5 veces.
         $       -> final de la cadena.

         Otro ejemplo: permitir solo letras y números:
         preg_match('/^[a-zA-Z0-9]+$/', "Ana123"); // 1

         IMPORTANTE:
         El patrón lo defines tú según el formato que necesites.
         preg_match() no valida cualquier formato automáticamente.
*/








?>