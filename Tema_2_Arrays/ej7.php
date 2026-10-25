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

$paisesAleatorios=array_rand($paises, 2);

$datosPais1=$paises[$paisesAleatorios[0]];
$datosPais2=$paises[$paisesAleatorios[1]];

//DATOS PAIS 1
echo "Pais: " . $paisesAleatorios[0] . "<br>";
echo "Capital: " . $datosPais1["Capital"] . "<br>";
echo "Poblacion: " . $datosPais1["Poblacion"] .  "<br>";

//DATOS PAIS 2
echo "Pais: " . $paisesAleatorios[1] . "<br>";
echo "Capital: " . $datosPais2["Capital"] . "<br>";
echo "Poblacion: " . $datosPais2["Poblacion"] . "<br>";


////////////////////////////////////////////////////////////////
$ciudadesPais1 = $ciudades[$paisesAleatorios[0]];
foreach($ciudadesPais1 as $ciudad){
    echo $ciudad . "<br>";
}

$ciudadesPais2=$ciudades[$paisesAleatorios[1]];
foreach($ciudadesPais2 as $ciudad){
    echo $ciudad . "<br>";
}


?>