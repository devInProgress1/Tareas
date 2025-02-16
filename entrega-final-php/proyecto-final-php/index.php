<?php
session_start();
define ('FPAG',10); // Número de filas por página
define('ATTEMPTS',3);
//constantes de subida de archivos
define('IMAGES_FOLDER','app/uploads/');
define('NO_FILE_UPLOADED', 4);
define('INVALID_FILE_TYPE', 'error');
define('UPLOAD_SUCCESS', 1);
define('MAX_FILE_SIZE',500000);

require_once 'app/helpers/util.php';
require_once 'app/config/configDB.php';
require_once 'app/models/Cliente.php';
require_once 'app/models/AccesoDatosPDO.php';
require_once 'app/controllers/crudclientes.php';
require_once 'app/validar/validar.php';
require_once 'app/functions/functions.php';

//validacion de usuario
if(!isset($_SESSION['rol'])){

    if(!isset($_SESSION['permitedAccesAttemps'])){
        $_SESSION['permitedAccesAttemps']=ATTEMPTS;
    }

    if($_SESSION['permitedAccesAttemps']==0){
        include_once "app/views/error.php";
    }

    if(!isset($_POST['login']) ||!isset($_POST['passwd'])){
        $msg='';
        include_once 'app/views/login.php';
    }
    crudValidateLogin($_POST);
}
//---- PAGINACIÓN ----
$midb = AccesoDatos::getModelo();
$totalfilas = $midb->numClientes();
if ( $totalfilas % FPAG == 0){
    $posfin = $totalfilas - FPAG;
} else {
    $posfin = $totalfilas - $totalfilas % FPAG;
}

if ( !isset($_SESSION['posini']) ){
  $_SESSION['posini'] = 0;
}
$posAux = $_SESSION['posini'];
//------------

// Borro cualquier mensaje "
$_SESSION['msg']=" ";

//Genero campo por el que ordeno por defecto y se ordena ascendentemente
if (!isset($_SESSION['fieldToOrder'])) {
    $_SESSION['fieldToOrder']='id';
    $_SESSION['orderBy']='ASC';
}

ob_start(); // La salida se guarda en el bufer

 if ( isset($_REQUEST['nav-detalles'])){
        switch ($_REQUEST['nav-detalles']) {
            case "siguiente"    : $_SESSION['orderBy'] == 'ASC' ? crudSiguiente($_REQUEST[$_SESSION['fieldToOrder']],$_SESSION['fieldToOrder']) : crudAnterior($_REQUEST[$_SESSION['fieldToOrder']],$_SESSION['fieldToOrder']) ; break;
            case "anterior"     : $_SESSION['orderBy'] == 'ASC' ? crudAnterior($_REQUEST[$_SESSION['fieldToOrder']],$_SESSION['fieldToOrder']) : crudSiguiente($_REQUEST[$_SESSION['fieldToOrder']],$_SESSION['fieldToOrder']) ; break;
        }
    }
if ($_SERVER['REQUEST_METHOD'] == "GET" ){
    
    // Proceso las ordenes de navegación
    if ( isset($_GET['nav'])) {
        switch ( $_GET['nav']) {
            case "Primero"  : $posAux = 0; break;
            case "Siguiente": $posAux +=FPAG; if ($posAux > $posfin) $posAux=$posfin; break;
            case "Anterior" : $posAux -=FPAG; if ($posAux < 0) $posAux =0; break;
            case "Ultimo"   : $posAux = $posfin;
        }
        $_SESSION['posini'] = $posAux;
    }


    // Proceso de ordenes de CRUD clientes
    if ( isset($_GET['orden'])){
        if ($_SESSION['rol'] == 1) { 
            switch ($_GET['orden']) {
                case "Nuevo"    : crudAlta(); break;
                case "Borrar"   : crudBorrar   ($_GET['id']); break;
                case "Modificar": crudModificar($_GET['id']); break;
            }
        }
        switch ($_GET['orden']) {    
            case "Detalles" : crudDetalles ($_GET['id']);break;
            case "Terminar" : crudTerminar(); break;
        }
    }

    //Ordenación por campo selecciondado y en caso de pulsar el mismo botón más de una vez se invertira la orientación de ordenación
    if ( isset($_GET['order_by'])){
        if ($_GET['order_by'] == $_SESSION['fieldToOrder']) {
            $_SESSION['orderBy'] = $_SESSION['orderBy'] == 'ASC' ? 'DESC' : 'ASC';
        }else{
            $_SESSION['fieldToOrder']=$_GET['order_by'];
            $_SESSION['orderBy'] = 'ASC';
        }
        $_SESSION['posini'] = 0;
    }

   
}
// POST Formulario de alta o de modificación
else {
    if (  isset($_POST['orden'])){
         switch($_POST['orden']) {
             case "Nuevo"    : crudPostAlta(); break;
             case "Modificar": crudPostModificar(); break;
             case "Detalles":; // No hago nada
         }
    }
}

// Si no hay nada en la buffer 
// Cargo genero la vista con la lista por defecto
if ( ob_get_length() == 0){
    $db = AccesoDatos::getModelo();
    $posini = $_SESSION['posini'];
    $tclientes = $db->getClientes($posini,FPAG,$_SESSION['fieldToOrder'],$_SESSION['orderBy']);
    require_once "app/views/list.php";    
}
$contenido = ob_get_clean();
$msg = $_SESSION['msg'];
// Muestro la página principal con el contenido generado
require_once "app/views/principal.php";


