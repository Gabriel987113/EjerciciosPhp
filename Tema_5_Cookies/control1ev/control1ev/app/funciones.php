<?php
require_once ('dat/datos.php');
/**
 *  Devuelve true si el código del usuario y contraseña se 
 *  encuentra en la tabla de usuarios
 *  @param $login : Código de usuario
 *  @param $clave : Clave del usuario
 *  @return true o false
 */
function userOk($login,$clave):bool {
    global $usuarios;
    /*
    $codigo = 200001;
    $datos = ["Alberto López", "123456", ROL_PROFESOR];
    */
    foreach($usuarios as $codigo => $datos){
        if($codigo == $login && $datos[1]==$clave){
            return true;
        }
    } 
    return false;
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios;

    foreach($usuarios as $codigo => $datos){
        if($codigo == $login){
            return $datos[2]; // o $usuarios[$codigo][2];
        }
    }
    return "no se ha encontrado el rol de ese alumno";
}

/**
 *  Muestra las notas del alumno indicado.
 *  @param $codigo: Código del usuario
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotasAlumno($codigo):String{
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;
    $contador=0;

    $msg .= " Bienvenido/a alumno/a: ". $usuarios[$codigo][0];
    $msg .= "<table>";
    $msg .= "<tr><th>Modulo</th><th>Nota</th></tr>";
     foreach($notas[$codigo] as $nota){ //recorremos del array notas solo la fila que corresponda al $codigo
        $msg .= "<tr><td>" . $nombreModulos[$contador] . "</td>" .  //// Mostramos el nombre del módulo utilizando el contador como índice.
        "<td>" . $nota .  "</td></tr>"; //// Mostramos la nota actual con $nota, que el foreach obtiene automáticamente.
        $contador++; //// Incrementamos el contador para pasar al siguiente módulo.
    }
    $msg .= "</table>";
    return $msg;
}

/**
 *  Muestra las notas de todos alumnos. 
 *  @param $codigo: Código del profesor
 *  @return $devuelve una cadena con una tabla html con los resultados 
 */
function verNotaTodas ($codigo): String {
    $msg="";
    global $nombreModulos;
    global $notas;
    global $usuarios;
  
    $msg .= " Bienvenido Profesor: ". $usuarios[$codigo][0];
    $msg .= "<table>";
    $msg .= "<tr><th>Nombre</th><th>Entorno servidor</th><th>Entorno cliente</th><th>Despliegue</th><th>Diseño</th>";
    foreach($notas as $codigoAlumno => $nota){
        $msg .= "<tr><td>" . $usuarios[$codigoAlumno][0] . "</td>" . 
        "<td>" . $nota[0] . "</td>" . 
        "<td>" . $nota[1] . "</td>" .
        "<td>" . $nota[2] . "</td>" .
        "<td>" . $nota[3] . "</td></tr>"; 
    } 
    $msg .= "</table>";
    return $msg;
}