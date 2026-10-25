
<?php
/*
1. CONTAR ELEMENTOS DE UN ARRAY

    1.1. count($array)
         Devuelve el número de elementos que contiene el array.
         Ejemplo:
         $dias = ['lunes', 'martes', 'miércoles'];

         $total = count($dias);
         echo "Hay $total días";

         if (count($dias) == 3) {
             echo " El array tiene tres elementos";
         }


2. ELIMINAR ELEMENTOS DE UN ARRAY

    2.1. array_pop($array)
         Elimina y devuelve el ÚLTIMO elemento.
         Modifica el array original.
         Ejemplo:
         $dias = ['lunes', 'martes', 'miércoles'];

         $ultimo = array_pop($dias);
         echo "Eliminado: $ultimo";

         print_r($dias);

    2.2. array_shift($array)
         Elimina y devuelve el PRIMER elemento.
         Modifica el array original.
         Ejemplo:
         $dias = ['lunes', 'martes', 'miércoles'];

         $primero = array_shift($dias);
         echo "Eliminado: $primero";

         print_r($dias);

    TRUCO:
    array_pop()   -> elimina el último.
    array_shift() -> elimina el primero.


3. INSERTAR ELEMENTOS EN UN ARRAY

    3.1. array_push($array, $valor)
         Añade uno o varios elementos al FINAL.
         Devuelve el número total de elementos del array ampliado.
         Modifica el array original.
         Ejemplo:
         $dias = ['lunes', 'martes'];

         array_push($dias, 'miércoles');

         if (count($dias) == 3) {
             echo "Elemento añadido correctamente";
         }

         print_r($dias);

    3.2. array_unshift($array, $valor)
         Añade uno o varios elementos al PRINCIPIO.
         Devuelve el número total de elementos del array ampliado.
         Modifica el array original.
         Ejemplo:
         $dias = ['martes', 'miércoles'];

         array_unshift($dias, 'lunes');

         echo $dias[0]; // lunes
         print_r($dias);

         IMPORTANTE:
         Las claves numéricas se reajustan.
         Las claves asociativas de texto se conservan.
         Los elementos añadidos reciben índices numéricos.

    TRUCO:
    array_push()    -> añade al final.
    array_unshift() -> añade al principio.


4. EXTRAER UNA PARTE SIN MODIFICAR EL ARRAY

    4.1. array_slice($array, $inicio, $cantidad)
         Devuelve una parte del array sin modificar el original.

         Ejemplo:
         $letras = ['a', 'b', 'c', 'd', 'e'];

         $parte = array_slice($letras, 1, 2);

         print_r($parte); // b, c

         echo count($letras); // 5: el original no cambia

         Otros ejemplos:
         array_slice($letras, 2);    // c, d, e
         array_slice($letras, 0, 3); // a, b, c
         array_slice($letras, -2, 1); // d

         IMPORTANTE:
         Si no se indica cantidad, extrae hasta el final.
         Los índices numéricos se reajustan por defecto.
         Si el inicio es negativo, cuenta desde el final.


5. EXTRAER Y SUSTITUIR ELEMENTOS

    5.1. array_splice($array, $inicio, $cantidad, $reemplazo)
         Elimina una parte del array y devuelve lo eliminado.
         Si se indica un reemplazo, sustituye los elementos eliminados.
         Modifica el array original.

         Ejemplo:
         $dias = ['lunes', 'martes', 'miércoles', 'jueves'];

         $eliminados = array_splice($dias, 1, 2);

         echo "Eliminados: ";
         print_r($eliminados);

         echo "Array restante: ";
         print_r($dias);

         Ejemplo sustituyendo:
         $dias = ['lunes', 'martes', 'miércoles', 'jueves'];

         array_splice($dias, 1, 2, ['festivo']);

         print_r($dias);
         // lunes, festivo, jueves

         IMPORTANTE:
         Si no se indica cantidad, elimina hasta el final.
         Los índices numéricos se reajustan.
         Si el inicio es negativo, cuenta desde el final.

    DIFERENCIA CLAVE:
    array_slice()  -> devuelve una parte, sin modificar el original.
    array_splice() -> elimina o sustituye, modificando el original.


6. REEMPLAZAR ELEMENTOS DE UN ARRAY

    6.1. array_replace($destino, $origen)
         Devuelve un nuevo array reemplazando los valores
         que tengan claves coincidentes.
         Si una clave solo existe en el origen, se añade.
         No modifica los arrays originales.

         Ejemplo:
         $persona = ['nombre' => 'Ana', 'edad' => 20];
         $nuevosDatos = ['edad' => 25];

         $resultado = array_replace($persona, $nuevosDatos);

         if ($resultado['edad'] == 25) {
             echo "La edad se ha actualizado";
         }

         print_r($resultado);

         IMPORTANTE:
         Si una clave está en ambos arrays, prevalece
         el valor del array origen.


7. INVERTIR EL ORDEN DEL ARRAY

    7.1. array_reverse($array, $mantener_claves)
         Devuelve un array con los elementos en orden inverso.
         No modifica el array original.

         Ejemplo:
         $numeros = [1, 2, 3, 4];

         $invertidos = array_reverse($numeros);

         foreach ($invertidos as $numero) {
             echo $numero . " ";
         }
         // 4 3 2 1

         7.1.1. array_reverse($array, true)
                Invierte el orden manteniendo las claves numéricas.
                Ejemplo:
                $letras = [0 => 'a', 1 => 'b', 2 => 'c'];

                $invertidas = array_reverse($letras, true);
                print_r($invertidas);
                // 2 => c, 1 => b, 0 => a

         IMPORTANTE:
         Por defecto, las claves numéricas se reajustan.
         Las claves de texto se conservan.


8. SELECCIONAR ELEMENTOS ALEATORIOS

    8.1. array_rand($array, $cantidad)
         Devuelve una o varias CLAVES aleatorias, no los valores.

         Ejemplo:
         $colores = ['azul', 'rojo', 'verde'];

         $indice = array_rand($colores);

         echo "Color elegido: " . $colores[$indice];

         Ejemplo eligiendo dos:
         $colores = ['azul', 'rojo', 'verde', 'amarillo'];

         $indices = array_rand($colores, 2);

         foreach ($indices as $indice) {
             echo $colores[$indice] . " ";
         }

         IMPORTANTE:
         Si se elige una sola clave, devuelve una clave.
         Si se eligen varias, devuelve un array de claves.


9. BUSCAR ELEMENTOS Y CLAVES

    9.1. array_search($valor, $array)
         Busca un valor y devuelve la primera clave donde aparece.
         Devuelve false si no lo encuentra.

         Ejemplo:
         $colores = ['azul', 'rojo', 'verde'];

         $indice = array_search('rojo', $colores);

         if ($indice !== false) {
             echo "Encontrado en la posición $indice";
         } else {
             echo "Color no encontrado";
         }

         IMPORTANTE:
         Usa === false para distinguirlo de la clave 0.

    9.2. array_key_exists($clave, $array)
         Comprueba si existe una clave.
         Devuelve true o false.
         Incluso detecta claves cuyo valor sea null.

         Ejemplo:
         $persona = ['nombre' => 'Ana', 'edad' => 20];

         if (array_key_exists('edad', $persona)) {
             echo "La clave edad existe";
         } else {
             echo "La clave edad no existe";
         }

    9.3. in_array($valor, $array)
         Comprueba si un valor está dentro del array.
         Devuelve true o false.

         Ejemplo:
         $colores = ['azul', 'rojo', 'verde'];

         if (in_array('rojo', $colores)) {
             echo "El color existe";
         } else {
             echo "El color no existe";
         }

         Para comprobar también el tipo de dato:
         in_array(2, ['2'], true); // No coincide estrictamente.

    9.4. array_keys($array)
         Devuelve un array con todas las claves.

         Ejemplo:
         $persona = ['nombre' => 'Ana', 'edad' => 20];

         $claves = array_keys($persona);

         foreach ($claves as $clave) {
             echo $clave . " ";
         }
         // nombre edad

    9.5. array_keys($array, $valor)
         Devuelve las claves cuyos valores coinciden con el indicado.

         Ejemplo:
         $colores = ['azul', 'rojo', 'verde', 'rojo'];

         $claves = array_keys($colores, 'rojo');

         print_r($claves); // [1, 3]

    TRUCO:
    array_search()     -> busca un valor y devuelve su primera clave.
    array_key_exists() -> comprueba si existe una clave.
    in_array()         -> comprueba si existe un valor.
    array_keys()       -> devuelve las claves.


10. MEZCLAR ELEMENTOS ALEATORIAMENTE

    10.1. shuffle($array)
          Mezcla los elementos en un orden aleatorio.
          Modifica el array original y devuelve true si tiene éxito.
          Reajusta los índices numéricos.

          Ejemplo:
          $numeros = [1, 2, 3, 4, 5];

          shuffle($numeros);

          foreach ($numeros as $numero) {
              echo $numero . " ";
          }

          IMPORTANTE:
          No conserva las claves asociativas de texto.


11. ORDENAR UN ARRAY

    11.1. sort($array)
          Ordena de menor a mayor.
          Modifica el array y reajusta las claves numéricas.

          Ejemplo:
          $numeros = [5, 2, 8, 1];

          sort($numeros);

          foreach ($numeros as $numero) {
              echo $numero . " ";
          }
          // 1 2 5 8

    11.2. asort($array)
          Ordena de menor a mayor manteniendo las claves.

          Ejemplo:
          $notas = ['Ana' => 8, 'Luis' => 5, 'Eva' => 9];

          asort($notas);

          foreach ($notas as $nombre => $nota) {
              echo "$nombre: $nota ";
          }
          // Luis: 5 Ana: 8 Eva: 9

    11.3. rsort($array)
          Ordena de mayor a menor.
          Modifica el array y reajusta las claves numéricas.

          Ejemplo:
          $numeros = [2, 8, 1, 5];

          rsort($numeros);

          foreach ($numeros as $numero) {
              echo $numero . " ";
          }
          // 8 5 2 1

    11.4. arsort($array)
          Ordena de mayor a menor manteniendo las claves.

          Ejemplo:
          $notas = ['Ana' => 8, 'Luis' => 5, 'Eva' => 9];

          arsort($notas);

          foreach ($notas as $nombre => $nota) {
              echo "$nombre: $nota ";
          }
          // Eva: 9 Ana: 8 Luis: 5

    TRUCO PARA RECORDAR:
    sort()  -> menor a mayor, reajusta índices.
    asort() -> menor a mayor, mantiene claves.
    rsort() -> mayor a menor, reajusta índices.
    arsort()-> mayor a menor, mantiene claves.
*/
?>