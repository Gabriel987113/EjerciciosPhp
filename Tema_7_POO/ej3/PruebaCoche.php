<?php

include_once 'Coche.php';

const META=500;
$parilla = [];

$parrilla  [0]  = new Coche("Ferrari", 300);
$parrilla  [1]  = new Coche("600", 100);
$parrilla  [2]  = new Coche("BMW", 220);
$parrilla  [3]  = new Coche ("Seat",150);
$parrilla  [4]  = new Coche ("La Cabra",10);

// Arranquen los motores
for ($i=0; $i< count($parrilla); $i++){
    $parrilla[$i]->arrancar();
}

// Comienza la carrera !!!!
do {
    for ($i = 0; $i < count($parrilla); $i++) {
        $parrilla[$i]->acelera(random_int(0, 20));
        $parrilla[$i]->recorre();
        $parrilla[$i]->frena(random_int(0,10));
        echo " <br> ".$parrilla[$i]->info();
    }
    
} while ( alcanzarMeta ( $parrilla, META) == false );


// Ordena la tabla para mostrar la clasificación
ordenarClasificacion ( $parrilla);

// Muestra la clasificación
for($i=0; $i< count($parrilla); $i++){
    echo ($i+1)."º Clasificado ". $parrilla[$i]->info()."<br>";
}

// MÉTODOS AUXILIARES
// Devuelve verdadero si hay algun coche que haya recorrido la distancia indicada.

function alcanzarMeta ( array $tcoches, int $distancia):bool{

       for ($i = 0; $i < count($tcoches); $i++) {

           if($tcoches[$i] -> getKilometros() >=$distancia){
           return true;
           }

    }

    return false;
}

/*
El operador <=> funciona así:
- Devuelve -1 si el valor de la izquierda es menor.
- Devuelve 0 si son iguales.
- Devuelve 1 si el valor de la izquierda es mayor.
No devuelve el coche mayor: ordena el array colocando primero el coche mayor.
*/
// Ordeno la tabla de objetos por los kilometros recorridos
function ordenarClasificacion ( array &$tcoches):void{
    
  usort($tcoches, function($a, $b){
    return $b->getKilometros()  <=> $a->getKilometros();
  });
}
?>