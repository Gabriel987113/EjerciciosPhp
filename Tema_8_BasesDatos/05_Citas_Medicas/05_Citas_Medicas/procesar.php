<?php
require_once "Paciente.php";
require_once "Medico.php";
require_once "AccesoDatos.php";

$cod_paciente = $_POST["cod_paciente"] ?? "";
$cod_medico = $_POST["cod_medico"] ?? "";
$fecha = $_POST["fecha"] ?? "";
$hora = $_POST["hora"] ?? "";
$mensaje = "";

function buscarPaciente($codigo) {
    return AccesoDatos::initModelo()->buscarPaciente($codigo);
}

function buscarMedico($codigo) {
    return AccesoDatos::initModelo()->buscarMedico($codigo);
}

function comprobarCita($medico, $fecha, $hora) {
    return AccesoDatos::initModelo()->existeCita($medico, $fecha, $hora);
}

function guardarCita($paciente, $medico, $fecha, $hora) {
    return AccesoDatos::initModelo()->insertarCita($paciente, $medico, $fecha, $hora);
}

// Comprobamos que la fecha no sea anterior a hoy.
if ($fecha < date("Y-m-d")) {
    $mensaje = "ERROR: No puedes reservar una cita en una fecha pasada.";
} else {
    $paciente = buscarPaciente($cod_paciente);

    if ($paciente == false) {
        $mensaje = "ERROR: El paciente no existe.";
    } else {
        $medico = buscarMedico($cod_medico);

        if ($medico == false) {
            $mensaje = "ERROR: El médico no existe.";
        } else {
            if (comprobarCita($cod_medico, $fecha, $hora)) {
                $mensaje = "Esa hora ya está ocupada para este médico.";
            } else {
                if (guardarCita($cod_paciente, $cod_medico, $fecha, $hora)) {
                    $mensaje = "Cita reservada correctamente.<br>";
                    $mensaje .= "Paciente: " . $paciente["nombre"] . "<br>";
                    $mensaje .= "Médico: " . $medico["nombre"] . "<br>";
                    $mensaje .= "Fecha: " . $fecha . "<br>";
                    $mensaje .= "Hora: " . $hora;
                } else {
                    $mensaje = "No se ha podido reservar la cita.";
                }
            }
        }
    }
}

echo $mensaje;
?>
