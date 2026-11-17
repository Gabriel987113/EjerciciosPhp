<?php 
/**
 *  Genera una cadena un texto de la clase -> 1: Turista, 2: Business,
 *  3: First Class
 * @param int $num
 * @return string - Texto asociado al valor del número
 */
function verClase( int $num):string {

    switch($num){
        case 1:
           return "Turista";
        case 2:
           return "Business";
        case 3:
           return "First Class";
        default:
           return "opcion no valida";
    }
    
    };

/**
 *  Muestra un mensaje según el valor de plazas, si es menor de 10  devuelve 
 *  la cadena 'Ultimas plazas' y es caso contrario 'Disponibles'
 * @param int $plazas
 * @return string
 */
function verEstado ( int $plazas):string {

    if($plazas<10){
        return "Ultimas plazas ";
    }else{
      return "Disponibles"; 
    }

  
 
}
