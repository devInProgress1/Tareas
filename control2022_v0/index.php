<?php
session_start();

//La primera vez que se inicializa la página se crea el campo oportunidades
if(!isset($_SESSION['attempts'])){
  $_SESSION['attempts']=4;
}

//En caso de no quedar mas oportunidades te muestra el mensaje de error
if($_SESSION['attempts']==0){
  $contenido = "<h1>Superado el número máximo de accesos erróneos</h1><hr><p>Reinicie el navegador para volver a intentarlo</p>";
  include_once('app/errorSesion.php');
  die();
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
      $_SESSION['attempts']=4;
      include_once ('app/resultado.php');
    } 
    // userOK falso
    else {
      //Si los datos son incorrectos se resta una oportunidad
       $_SESSION['attempts']-=1;
       $contenido = "El número de usuario y la contraseña no son válidos";
       include_once('app/acceso.php');
    }
} else {
    $contenido = " Introduzca su número de usuario y su contraseña";
    include_once('app/acceso.php');
}


