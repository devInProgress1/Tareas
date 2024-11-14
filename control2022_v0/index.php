<?php
session_start();

define("ATTEMPTS",5);
//La primera vez que se inicializa la página se crea el campo oportunidades
if(!isset($_SESSION['attempts'])){
  $_SESSION['attempts']=ATTEMPTS;
}

include_once('app/funciones.php');

if (  !empty( $_GET['login']) && !empty($_GET['clave'])){
    if ( userOk($_GET['login'],$_GET['clave'])){
      if ( getUserRol($_GET['login']) == ROL_PROFESOR){
        $contenido = verNotaTodas($_GET['login']);
      } else {
        $contenido = verNotasAlumno($_GET['login']);
      }
      //El contador se reinicia
      $_SESSION['attempts']=ATTEMPTS;
      include_once ('app/resultado.php');
    } 
    // userOK falso
    else {
      //En caso de no quedar mas oportunidades te muestra el mensaje de error Si los datos son incorrectos se resta una oportunidad
      $_SESSION['attempts']-=1;
      if($_SESSION['attempts']==0){
        showError($contenido);
      }
       $contenido = "El número de usuario y la contraseña no son válidos";
       include_once('app/acceso.php');
    }
} else {
    $contenido = " Introduzca su número de usuario y su contraseña";
    include_once('app/acceso.php');
}

