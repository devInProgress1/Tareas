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
    return $usuarios[$login][1]==$clave ? true:false;
}

/**
 *  Devuelve el rol asociado al usuario
 *  @param $login: código de usuario
 *  @return ROL_ALUMNO o ROL_PROFESOR
 */
function getUserRol($login){
    global $usuarios;
    return $usuarios[$login][2];
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

    $msg .= " Bienvenido/a alumno/a: ".$usuarios[$codigo][0];
    $msg .= "<table>";
    foreach ($nombreModulos as $value) {
    $msg .= "<tr>";
    $msg .= "<td>".$value."</td>";
    $possition=array_keys($nombreModulos,$value);
    $msg .= "<td>".$notas[$codigo][$possition[0]]."</td>";
    $msg .= "</tr>";
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
    $msg .= " Bienvenido Profesor: ".$usuarios[$codigo][0];
    $msg .= "<table>";
    $msg .= "<tr><th>Notas</th>";
    foreach ($nombreModulos as $value) {
        $msg .= "<td>".$value."</td>";
    }
    $msg .= "</tr>";
    foreach ($notas as $key=>$value) {
        $msg .= "<tr>";
        $msg .= "<td>".$usuarios[$key][0]."</td>";
        foreach ($notas[$key] as $value) {
            $msg .= "<td>".$value."</td>";
        }
            
        $msg .= "</tr>";
    }
    $msg .= "</table>";
    return $msg;
}