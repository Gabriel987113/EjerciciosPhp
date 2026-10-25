
<?php
/*
1. COMPROBAR SI EXISTE UNA VARIABLE O ESTÁ VACÍA

    1.1. isset($var)
         Comprueba si la variable existe y NO es null.
         Devuelve true si existe y tiene un valor distinto de null.
         Ejemplo:
         $edad = 0;
         isset($edad); // true

         IMPORTANTE:
         isset() devuelve true aunque el valor sea 0, "", false o [].
         Solo devuelve false si no existe o vale null.

    1.2. empty($var)
         Comprueba si la variable está vacía.
         Devuelve true si no existe o vale:
         null, "", 0, "0", false o [].
         Ejemplo:
         $nombre = "";
         empty($nombre); // true

    1.3. array_key_exists("clave", $array)
         Comprueba si una clave existe dentro de un array,
         incluso si su valor es null.
         Ejemplo:
         $datos = ["nombre" => null];
         array_key_exists("nombre", $datos); // true

         IMPORTANTE:
         isset() y empty() comprueban variables.
         array_key_exists() comprueba claves de un array.

    1.4. CHECKBOX Y RADIO EN FORMULARIOS
         Los checkbox y radio normalmente solo se envían
         si están marcados o seleccionados.


2. VALIDAR DATOS CON filter_var() Y filter_input()

    2.1. filter_var($variable, FILTRO)
         Valida o limpia un dato que ya está guardado
         en una variable.
         Ejemplo:
         $correo = "ana@gmail.com";
         filter_var($correo, FILTER_VALIDATE_EMAIL);

    2.2. filter_input(TIPO, "nombre", FILTRO)
         Obtiene un dato directamente de la entrada indicada
         (GET, POST, COOKIE, etc.) y aplica el filtro.
         Ejemplo:
         $correo = filter_input(
             INPUT_POST,
             "correo",
             FILTER_VALIDATE_EMAIL
         );

         INPUT_POST   -> datos enviados mediante POST.
         INPUT_GET    -> datos enviados mediante GET.
         INPUT_COOKIE -> datos procedentes de una cookie.

    2.3. FILTROS DE VALIDACIÓN (FILTER_VALIDATE_*)

         a) FILTER_VALIDATE_EMAIL
            Comprueba si el formato de un correo es válido.
            Ejemplo:
            filter_var("ana@gmail.com", FILTER_VALIDATE_EMAIL);

         b) FILTER_VALIDATE_INT
            Comprueba si el valor es un número entero.
            Ejemplo:
            filter_var("25", FILTER_VALIDATE_INT);

            También permite establecer un mínimo y un máximo:
            filter_var("25", FILTER_VALIDATE_INT, [
                "options" => [
                    "min_range" => 18,
                    "max_range" => 99
                ]
            ]);

         c) FILTER_VALIDATE_FLOAT
            Comprueba si el valor es un número decimal.
            Ejemplo:
            filter_var("3.14", FILTER_VALIDATE_FLOAT);

         d) FILTER_VALIDATE_BOOLEAN
            Interpreta valores como true o false.
            "1", "true", "on" y "yes" -> true.
            Otros valores reconocidos como falsos -> false.
            Ejemplo:
            filter_var("yes", FILTER_VALIDATE_BOOLEAN); // true

            IMPORTANTE:
            Para distinguir un valor inválido de false,
            se puede usar FILTER_NULL_ON_FAILURE.

         e) FILTER_VALIDATE_URL
            Comprueba si una URL tiene un formato válido.
            Ejemplo:
            filter_var("https://google.com", FILTER_VALIDATE_URL);

         f) FILTER_VALIDATE_IP
            Comprueba si una dirección IP es válida.
            Ejemplo:
            filter_var("192.168.1.1", FILTER_VALIDATE_IP);

         g) FILTER_VALIDATE_DOMAIN
            Comprueba si un dominio tiene un formato válido.
            Ejemplo:
            filter_var("google.com", FILTER_VALIDATE_DOMAIN, [
                "flags" => FILTER_FLAG_HOSTNAME
            ]);

    2.4. RESULTADO DE LA VALIDACIÓN
         Los filtros de validación devuelven false si el dato
         no cumple el formato esperado.

         filter_input() devuelve null si el dato no está disponible.

         Para comprobar expresamente si falla la validación:
         $resultado === false

         DIFERENCIA CLAVE:
         filter_var()   -> trabaja con una variable existente.
         filter_input() -> obtiene el dato directamente de la entrada.
*/
?>