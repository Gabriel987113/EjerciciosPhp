<?php
/*
=========================================================
              CHULETA DE ARRAYS EN PHP
=========================================================

Un array sirve para guardar varios valores en una variable.

Ejemplo:
$numeros = [10, 20, 30];
$persona = ["nombre" => "Ana", "edad" => 20];

---------------------------------------------------------
1. CREAR Y CONTAR ARRAYS
---------------------------------------------------------

array()          -> Crea un array.
count()          -> Cuenta los elementos.
sizeof()         -> Igual que count().
array_is_list()  -> Comprueba si es una lista normal.
range()          -> Crea una lista de números.
compact()        -> Crea un array usando variables.

Ejemplos:
$numeros = array(1, 2, 3);
echo count($numeros);            // 3
$lista = range(1, 5);            // [1, 2, 3, 4, 5]

---------------------------------------------------------
2. OBTENER CLAVES Y VALORES
---------------------------------------------------------

array_keys()       -> Devuelve todas las claves.
array_values()     -> Devuelve todos los valores.
array_key_exists() -> Comprueba si existe una clave.
key_exists()       -> Igual que array_key_exists().
array_key_first()  -> Devuelve la primera clave.
array_key_last()   -> Devuelve la última clave.
array_first()      -> Devuelve el primer valor.
array_last()       -> Devuelve el último valor.
current()          -> Devuelve el valor actual del puntero.
key()              -> Devuelve la clave actual.
list()             -> Guarda valores de un array en variables.
extract()          -> Crea variables a partir de las claves.
each()             -> Función antigua, eliminada en PHP 8.
pos()              -> Alias de current().

Ejemplo:
$persona = ["nombre" => "Ana", "edad" => 20];

echo $persona["nombre"];         // Ana
print_r(array_keys($persona));   // nombre, edad
print_r(array_values($persona));// Ana, 20

if (array_key_exists("edad", $persona)) {
    echo "Existe la edad";
} else {
    echo "No existe";
}

---------------------------------------------------------
3. BUSCAR ELEMENTOS
---------------------------------------------------------

in_array()      -> Comprueba si un valor está en el array.
array_search()  -> Busca un valor y devuelve su clave.
array_find()    -> Devuelve el primer valor que cumple una condición.
array_find_key()-> Devuelve la clave del primer valor que cumple.

Ejemplo:
$frutas = ["manzana", "pera", "plátano"];

if (in_array("pera", $frutas)) {
    echo "Está en el array";
} else {
    echo "No está";
}

echo array_search("pera", $frutas); // 1

---------------------------------------------------------
4. AÑADIR Y ELIMINAR ELEMENTOS
---------------------------------------------------------

array_push()    -> Añade elementos al final.
array_pop()     -> Elimina el último elemento.
array_unshift() -> Añade elementos al principio.
array_shift()   -> Elimina el primer elemento.

Ejemplo:
$numeros = [1, 2, 3];

array_push($numeros, 4);  // [1, 2, 3, 4]
array_pop($numeros);      // Elimina el 4
array_unshift($numeros, 0); // [0, 1, 2, 3]
array_shift($numeros);    // Elimina el 0

---------------------------------------------------------
5. ORDENAR ARRAYS
---------------------------------------------------------

sort()         -> Ordena de menor a mayor y cambia las claves.
rsort()        -> Ordena de mayor a menor y cambia las claves.
asort()        -> Ordena valores de menor a mayor y conserva claves.
arsort()       -> Ordena valores de mayor a menor y conserva claves.
ksort()        -> Ordena por claves de menor a mayor.
krsort()       -> Ordena por claves de mayor a menor.
natsort()      -> Ordena de forma natural.
natcasesort()  -> Orden natural sin distinguir mayúsculas.
shuffle()      -> Mezcla los elementos al azar.
array_multisort() -> Ordena arrays relacionados.
uasort()       -> Ordena valores con una función propia.
uksort()       -> Ordena claves con una función propia.
usort()        -> Ordena con una función de comparación.

Ejemplo:
$numeros = [30, 10, 20];
sort($numeros);
print_r($numeros); // [10, 20, 30]

---------------------------------------------------------
6. UNIR, COPIAR Y CAMBIAR ARRAYS
---------------------------------------------------------

array_merge()           -> Une varios arrays.
array_merge_recursive() -> Une arrays de forma recursiva.
array_combine()          -> Crea un array con claves y valores.
array_replace()          -> Sustituye valores por otros.
array_replace_recursive()-> Sustituye valores recursivamente.
array_flip()             -> Intercambia claves y valores.
array_change_key_case()  -> Cambia claves a mayúsculas/minúsculas.
array_fill()             -> Rellena un array con un valor.
array_fill_keys()        -> Crea claves con un mismo valor.
array_pad()              -> Añade valores hasta alcanzar un tamaño.

Ejemplo:
$a = [1, 2];
$b = [3, 4];

$resultado = array_merge($a, $b);
// [1, 2, 3, 4]

---------------------------------------------------------
7. EXTRAER, DIVIDIR Y DAR LA VUELTA
---------------------------------------------------------

array_slice()   -> Extrae una parte sin modificar el original.
array_splice()  -> Extrae, elimina o sustituye una parte.
array_chunk()   -> Divide un array en grupos.
array_reverse() -> Invierte el orden.
array_column()  -> Extrae una columna de un array.
array_unique()  -> Elimina valores repetidos.
array_is_list() -> Comprueba si las claves son consecutivas.

Ejemplo:
$numeros = [10, 20, 30, 40];

print_r(array_slice($numeros, 1, 2));
// [20, 30]

print_r(array_reverse($numeros));
// [40, 30, 20, 10]

---------------------------------------------------------
8. COMPARAR ARRAYS
---------------------------------------------------------

array_diff()          -> Valores que están en el primero, pero no
                         en los demás.
array_diff_assoc()    -> Compara valores y claves.
array_diff_key()      -> Compara claves.
array_intersect()     -> Valores que tienen en común.
array_intersect_assoc()-> Compara valores y claves.
array_intersect_key() -> Claves que tienen en común.

Funciones con u:
array_diff_uassoc()      -> Diferencia comparando claves con función.
array_diff_ukey()        -> Diferencia de claves con función.
array_udiff()            -> Diferencia de valores con función.
array_udiff_assoc()      -> Diferencia de valores y claves con función.
array_udiff_uassoc()     -> Diferencia comparando valores y claves.
array_uintersect()       -> Intersección comparando valores.
array_uintersect_assoc() -> Intersección de valores y claves.
array_uintersect_uassoc()-> Intersección de valores y claves con función.
array_intersect_uassoc() -> Intersección con comparación propia de claves.
array_intersect_ukey()   -> Intersección de claves con función.

Ejemplo:
$a = [1, 2, 3];
$b = [2, 3, 4];

print_r(array_diff($a, $b));      // [1]
print_r(array_intersect($a, $b)); // [2, 3]

---------------------------------------------------------
9. RECORRER Y MODIFICAR ARRAYS
---------------------------------------------------------

array_map()       -> Aplica una operación a cada elemento.
array_filter()    -> Deja solo los elementos que cumplen algo.
array_walk()      -> Ejecuta una función para cada elemento.
array_walk_recursive() -> Recorre también arrays interiores.
array_reduce()    -> Reduce los elementos a un único resultado.
array_all()       -> Comprueba si todos cumplen una condición.
array_any()       -> Comprueba si alguno cumple una condición.

Ejemplo sencillo:
$numeros = [1, 2, 3, 4];
$pares = array_filter($numeros, function($n) {
    return $n % 2 == 0;
});
print_r($pares); // [2, 4]

---------------------------------------------------------
10. OPERACIONES MATEMÁTICAS
---------------------------------------------------------

array_sum()     -> Suma los valores.
array_product() -> Multiplica los valores.
array_count_values() -> Cuenta cuántas veces aparece cada valor.

Ejemplo:
$numeros = [2, 3, 2, 5];

echo array_sum($numeros);     // 12
echo array_product($numeros); // 60
print_r(array_count_values($numeros));
// 2 aparece 2 veces, 3 aparece 1 vez y 5 aparece 1 vez.

---------------------------------------------------------
11. PUNTERO INTERNO DEL ARRAY
---------------------------------------------------------

reset() -> Vuelve al primer elemento.
end()   -> Va al último elemento.
next()  -> Avanza al siguiente elemento.
prev()  -> Retrocede al anterior.

Estas funciones mueven el puntero interno del array.

---------------------------------------------------------
12. FUNCIONES MENOS HABITUALES
---------------------------------------------------------

array_rand() -> Elige claves aleatorias.
array_all()  -> Comprueba si todos cumplen una condición.
array_any()  -> Comprueba si alguno cumple una condición.
array_find() -> Busca el primer elemento que cumple.
array_find_key() -> Busca la primera clave que cumple.

---------------------------------------------------------
13. RESUMEN RÁPIDO PARA EL EXAMEN
---------------------------------------------------------

count()           -> Contar.
in_array()        -> Comprobar si existe un valor.
array_search()    -> Buscar la clave de un valor.
array_keys()      -> Obtener claves.
array_values()    -> Obtener valores.
array_push()      -> Añadir al final.
array_pop()       -> Quitar del final.
array_shift()     -> Quitar del principio.
array_unshift()   -> Añadir al principio.
sort()            -> Ordenar ascendente.
rsort()           -> Ordenar descendente.
array_merge()     -> Unir arrays.
array_slice()     -> Extraer una parte.
array_splice()    -> Eliminar o sustituir una parte.
array_reverse()   -> Invertir.
array_unique()    -> Quitar duplicados.
array_sum()       -> Sumar.
array_product()   -> Multiplicar.
array_diff()      -> Diferencias.
array_intersect() -> Elementos comunes.
array_filter()    -> Filtrar.
array_map()       -> Transformar elementos.
array_column()    -> Obtener una columna.
array_chunk()     -> Dividir en grupos.

=========================================================
NOTA:
Las funciones con "u" suelen permitir comparar mediante
una función propia. Las funciones con "assoc" tienen en
cuenta las claves además de los valores.

Algunas funciones necesitan PHP moderno. Por ejemplo,
array_find(), array_find_key() y array_all() están
disponibles desde PHP 8.4; array_any() también desde PHP 8.4.

Las funciones antiguas como each() ya no están disponibles
en PHP 8.
=========================================================
*/
?>