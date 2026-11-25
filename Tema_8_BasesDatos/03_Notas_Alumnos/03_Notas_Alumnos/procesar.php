<?php
require_once "Alumno.php";
require_once "Nota.php";
require_once "AccesoDatos.php";

$cod_alumno = $_POST["cod_alumno"] ?? "";
$asignatura = trim($_POST["asignatura"] ?? "");
$nota = $_POST["nota"] ?? "";
$mensaje = "";

function buscarAlumno($codigo) {
    return AccesoDatos::initModelo()->buscarAlumno($codigo);
}

function guardarNota($codigo, $asignatura, $nota) {
    return AccesoDatos::initModelo()->insertarNota($codigo, $asignatura, $nota);
}

function obtenerMedia($codigo) {
    return AccesoDatos::initModelo()->calcularMedia($codigo);
}

// Comprobamos los datos de la nota.
if (!is_numeric($nota) || $nota < 0 || $nota > 10 || $asignatura == "") {
    $mensaje = "ERROR: Introduce una asignatura y una nota entre 0 y 10.";
} else {
    $alumno = buscarAlumno($cod_alumno);

    if ($alumno == false) {
        $mensaje = "ERROR: El alumno no existe.";
    } else {
        if (guardarNota($cod_alumno, $asignatura, $nota)) {
            $media = obtenerMedia($cod_alumno);
            $mensaje = "Nota guardada correctamente.<br>";
            $mensaje .= "Alumno: " . $alumno["nombre"] . "<br>";
            $mensaje .= "Media actual: " . number_format((float)$media, 2) . "<br>";

            if ($media >= 5) {
                $mensaje .= "Estado: APROBADO";
            } else {
                $mensaje .= "Estado: SUSPENSO";
            }
        } else {
            $mensaje = "No se ha podido guardar la nota.";
        }
    }
}

echo $mensaje;
?>
