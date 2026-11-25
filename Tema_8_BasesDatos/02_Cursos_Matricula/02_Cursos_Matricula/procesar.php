<?php
require_once "Alumno.php";
require_once "Curso.php";
require_once "AccesoDatos.php";

$cod_alumno = $_POST["cod_alumno"] ?? "";
$cod_curso = $_POST["cod_curso"] ?? "";
$mensaje = "";

function buscarAlumno($codigo) {
    return AccesoDatos::initModelo()->buscarAlumno($codigo);
}

function buscarCurso($codigo) {
    return AccesoDatos::initModelo()->buscarCurso($codigo);
}

function comprobarMatricula($alumno, $curso) {
    return AccesoDatos::initModelo()->existeMatricula($alumno, $curso);
}

function realizarMatricula($alumno, $curso) {
    return AccesoDatos::initModelo()->matricular($alumno, $curso);
}

// Buscamos al alumno.
$alumno = buscarAlumno($cod_alumno);

if ($alumno == false) {
    $mensaje = "ERROR: El alumno no existe.";
} else {
    // Buscamos el curso.
    $curso = buscarCurso($cod_curso);

    if ($curso == false) {
        $mensaje = "ERROR: El curso no existe.";
    } else {
        if (comprobarMatricula($cod_alumno, $cod_curso)) {
            $mensaje = "Este alumno ya está matriculado en ese curso.";
        } else {
            if ($curso["plazas_ocupadas"] < $curso["plazas_max"]) {
                if (realizarMatricula($cod_alumno, $cod_curso)) {
                    $mensaje = "Matrícula realizada correctamente.<br>";
                    $mensaje .= "Alumno: " . $alumno["nombre"] . "<br>";
                    $mensaje .= "Curso: " . $curso["nombre_curso"] . "<br>";
                    $mensaje .= "Plazas ocupadas ahora: " . ($curso["plazas_ocupadas"] + 1);
                } else {
                    $mensaje = "No se ha podido realizar la matrícula.";
                }
            } else {
                $mensaje = "No quedan plazas disponibles en este curso.";
            }
        }
    }
}

echo $mensaje;
?>
