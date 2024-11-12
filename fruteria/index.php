<?php

session_start();

if($_SERVER['REQUEST_METHOD']=="GET"){
    //Si se envía el campo cliente genera cliente en la sesión y muestra la página de compra
    //si no se encuentra el campo cliente te muestra la pantalla de bienvenida
    if(isset($_REQUEST['cliente'])){
        $_SESSION['cliente']=$_REQUEST['cliente'];
        include_once 'app/compra.php';
    }else{
        include_once 'app/bienvenida.php';
    }
}

if($_SERVER['REQUEST_METHOD']=="POST"){

    $option=trim($_REQUEST['accion']); 
    switch ($option) {
        //añade el valor a la fruta selecionada
        case 'Anotar':
            alterFruitsValue();
            $compraRealizada=alterFruitsDisplay();
            break;
        //Muestra la tabla y cierra la sesión
        case 'Terminar':
            $compraRealizada=alterFruitsDisplay();
            session_destroy();
            break;
        //Borra el valor de la fruta en la sesión
        case 'Anular':
            unset($_SESSION['frutas'][$_REQUEST['fruta']]);
            break;
    }
    $compraRealizada=alterFruitsDisplay();
    $option=='Terminar' ? include_once 'app/despedida.php' : include_once 'app/compra.php';

}

//En caso de intentar añadir valores negativos no se modificara nada, si no existe el array frutas
//lo crea y en el caso de no existir la fruta la crea. Por último añade el valor cantidad a la fruta correspondiente
function alterFruitsValue(){
    $actualFruit=$_REQUEST['fruta'];
    if($_REQUEST['cantidad']>0){
        if(!isset($_SESSION['frutas'])){
            $_SESSION['frutas']=[];
        }
        if(!isset($_SESSION['frutas'][$actualFruit])){
            $_SESSION['frutas'][$actualFruit]=0;
        }
        $_SESSION['frutas'][$actualFruit]+=$_REQUEST['cantidad'];
    }
    
}

//genera una tabla con los valores de frutas
function alterFruitsDisplay(){
    if(!$_SESSION['frutas']==[]){
        $displayString="Este es su pedido: <br><table style='border-style: solid;'>";
        foreach($_SESSION['frutas'] as $fruit => $value){
            if(is_int($value)){
                $displayString .= "<tr><td>".$fruit."</td><td>".$value."</td></tr>";
            }
        }
        $displayString .= "</table>";
    } 
    return $displayString;
}
?>