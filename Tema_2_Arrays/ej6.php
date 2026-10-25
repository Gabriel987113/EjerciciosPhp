<?php

// Forma antigua de definir Array en PHP
$paises = array(
'Francia' => array("Capital" => "París", "Poblacion" => "50000000"),
'España' => array("Capital" => "Madrid", "Poblacion" => "42000000"),
'Italia' => array("Capital" => "Roma", "Poblacion" => "46000000"),
'Argentina' => array("Capital" => "Buenos Aires", "Poblacion" => "40000000"),
'Colombia' => array("Capital" => "Bogotá", "Poblacion" => "36000000"),
'Chile' => array("Capital" => "Santiago", "Poblacion" => "36000000"),
'Suecia' => array("Capital" => "Estocolmo", "Poblacion" => "25000000"),
);
// Forma moderna, mas compacta
$ciudades = [
'Francia' => ["París","Burdeos","Niza","Lille","Nantes"],
'España' => ["Madrid", "Barcelona","León","Sevilla", "Valencia", "Málaga"],
'Italia' => ["Roma", "Venecia","Florencia","Pisa", "Génova", "Milán", "Turín",
"Nápoles"],
'Argentina' => ["Buenos Aires", "Córdoba","Parana","Rosario"],
'Colombia' => ["Bogotá", "Medellín","Cali","Barranquilla", "Bucaramanga"],
'Chile' => ["Santiago", "Arica","Iquique","Osorno", "Viña del Mar"],
'Suecia' => ["Estocolmo", "Upsala","Gotemburgo","Lund"],
];

function paisConMasPoblacion($paises){

     $paisMayor="";
     $paisMasPoblacion=0;

foreach($paises as $pais => $datos){

     if($datos["Poblacion"] > $paisMasPoblacion){
         $paisMasPoblacion=$datos["Poblacion"];
         $paisMayor=$pais;
     }
}

return array($paisMayor,$paisMasPoblacion);
}

$resultado=paisConMasPoblacion($paises);
/////////////////////////////////////////////////////////// Apartado 1
$ciudadesPais=$ciudades[$resultado[0]];

echo "PAIS: " . $resultado[0] . "<br>";
echo "Poblacion: ". $resultado[1] . "<br>";

foreach($ciudadesPais as $ciudad){
    echo $ciudad . "<br>";
}

///////////////////////////////////////////////////Apartado 2
$poblaciones=[];

foreach($paises as $pais => $datos){
    $poblaciones[] = $datos["Poblacion"];
}

$nombres=[];
foreach($paises as $pais =>$datos){
    $nombres[] = $pais;
}

array_multisort($poblaciones, $nombres);
/////////////////////////////////////////////////////////////
echo "País: " . $nombres[count($nombres) - 1] . "<br>";
echo "Población: " . $poblaciones[count($poblaciones) - 1] . "<br>";

$ciudadesPais=$ciudades[$nombres[count($nombres)-1]];
?>