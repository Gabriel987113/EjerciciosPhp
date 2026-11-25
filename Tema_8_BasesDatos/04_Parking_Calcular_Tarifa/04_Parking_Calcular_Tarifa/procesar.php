<?php
require_once "Ticket.php";
require_once "AccesoDatos.php";

$matricula = strtoupper(trim($_POST["matricula"] ?? ""));
$tipo = $_POST["tipo"] ?? "";
$horas = $_POST["horas"] ?? "";
$mensaje = "";

function calcularImporte($tipo, $horas) {
    // Elegimos el precio por hora.
    if ($tipo == "coche") {
        $tarifa = 2;
    } else {
        $tarifa = 1;
    }

    $importe = $tarifa * $horas;

    // Aplicamos el descuento si supera cinco horas.
    if ($horas > 5) {
        $importe = $importe * 0.90;
    }

    return $importe;
}

function guardarTicket($matricula, $tipo, $horas, $importe) {
    return AccesoDatos::initModelo()->guardarTicket($matricula, $tipo, $horas, $importe);
}

// Validamos los datos.
if ($matricula == "" || !filter_var($horas, FILTER_VALIDATE_INT) || $horas < 1 || $horas > 24) {
    $mensaje = "ERROR: Comprueba la matrícula y las horas (de 1 a 24).";
} elseif ($tipo != "coche" && $tipo != "moto") {
    $mensaje = "ERROR: El tipo de vehículo no es válido.";
} else {
    $importe = calcularImporte($tipo, $horas);

    if (guardarTicket($matricula, $tipo, $horas, $importe)) {
        $mensaje = "Ticket guardado correctamente.<br>";
        $mensaje .= "Matrícula: " . $matricula . "<br>";
        $mensaje .= "Tipo: " . $tipo . "<br>";
        $mensaje .= "Horas: " . $horas . "<br>";
        $mensaje .= "Importe total: " . number_format($importe, 2) . " euros";
    } else {
        $mensaje = "No se ha podido guardar el ticket.";
    }
}

echo $mensaje;
?>
