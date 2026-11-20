<?php

// DEVUELVE EL NOMBRE DE LA CLASE DEL VUELO

function verClase(int $num): string {

    switch ($num) {

        case 1:
            return "Turista";

        case 2:
            return "Business";

        case 3:
            return "First Class";

        default:
            return "Opción no válida";
    }
}


// DEVUELVE EL ESTADO DE LAS PLAZAS

function verEstado(int $plazas): string {

    if ($plazas < 10) {
        return "Últimas plazas";
    } else {
        return "Disponibles";
    }
}

?>