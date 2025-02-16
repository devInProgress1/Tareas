<?php


function crudValidateLogin($loginData){
    $db = AccesoDatos::getModelo();
    $data = $db->getUserData($loginData['login']);
    $isValid=false;
    
    if($data==true){
        $isValid=password_verify($loginData['passwd'],$data['password']);
    }

    if($data!=false||$isValid!=false){
        $_SESSION['rol']=$data['role'];
        return;
    }

    $_SESSION['permitedAccesAttemps']-=1;
    $msg="Usuario y o contraseña invalidos";
    include_once $_SESSION['permitedAccesAttemps']==0? "app/views/error.php":"app/views/login.php";
}

function crudBorrar ($id){   

    $db = AccesoDatos::getModelo();
    $resu = $db->borrarCliente($id);
    if ( $resu){
         $_SESSION['msg'] = " El usuario ".$id. " ha sido eliminado.";
    } else {
         $_SESSION['msg'] = " Error al eliminar el usuario ".$id.".";
    }

}

function crudTerminar(){
    AccesoDatos::closeModelo();
    session_destroy();
}
 
function crudAlta(){
    $cli = new Cliente();
    $orden= "Nuevo";
    include_once "app/views/formulario.php";
}

function crudDetalles($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);

    $image = "app/uploads/".getImageName($cli->id);
    $flag=getFlag($cli->ip_address);

    include_once "app/views/detalles.php";
}

function crudSiguiente($id,$field){
    $db = AccesoDatos::getModelo();
    $try = $db->nextUser($id,$field);
    
    if($try == false){
        $_SESSION['msg'] ="No hay mas usuarios";
        $cli= $db->getCLiente($_REQUEST['id']);
    }else{
    $cli = $try;
    }
    $image = "app/uploads/".getImageName($cli->id);
    $flag=getFlag($cli->ip_address);
    $orden="Modificar";
    include_once $_SERVER["REQUEST_METHOD"]=="GET"?"app/views/detalles.php": "app/views/formulario.php";
}

function crudAnterior($id,$field){
    $db = AccesoDatos::getModelo();
    $try = $db->previousUser($id,$field);
    if($try == false){
        $_SESSION['msg'] ="No hay mas usuarios";
        $cli= $db->getCLiente($_REQUEST['id']);
    }else{
    
    $cli = $try;


    }
    $image = "app/uploads/".getImageName($cli->id);
    $flag=getFlag($cli->ip_address);
    $orden="Modificar";
    include_once $_SERVER["REQUEST_METHOD"]=="GET"?"app/views/detalles.php": "app/views/formulario.php";
}

function crudModificar($id){
    $db = AccesoDatos::getModelo();
    $cli = $db->getCliente($id);
    $orden="Modificar";

    $image = "app/uploads/".getImageName($cli->id);
    $flag=getFlag($cli->ip_address);

    include_once "app/views/formulario.php";
}

function crudPostAlta(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $db = AccesoDatos::getModelo();
    $validData=validateData($_POST['ip_address'],$_POST['telefono'],$_POST['email']);
    if($validData!=null){
        $_SESSION['msg']=$validData;
        crudAlta();
        return;
    }
    $cli = new Cliente();
    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    if ( $db->addCliente($cli) ) {
           $_SESSION['msg'] = " El usuario ".$cli->first_name." se ha dado de alta ";
            $imageMessage='.';
            switch (uploadImage($_FILES['profileImage'],$db->lastId())) {
                case NO_FILE_UPLOADED:
                    $imageMessage="\n No ha selecionado ninguna imagen de perfil";
                    break;

                case INVALID_FILE_TYPE:
                    $imageMessage="\n La imagen no cumple con los requerimientos necesarios";
                    break;

                case UPLOAD_SUCCESS:
                    $imageMessage="\n Imagen subida con exito";
                    break;
            }
            $_SESSION['msg'] .= " ".$imageMessage;
        } else {
            $_SESSION['msg'] = " Error al dar de alta al usuario ".$cli->first_name."."; 
        }
}

function crudPostModificar(){
    limpiarArrayEntrada($_POST); //Evito la posible inyección de código
    $db = AccesoDatos::getModelo();
    $validData=validateData($_POST['ip_address'],$_POST['telefono'],$_POST['email'],$_POST['id']);
    $_SESSION['msg']=$validData;
    if($validData!=null){
        $_SESSION['msg']=$validData;
        crudModificar($_POST['id']);
        return;
    }
    $cli = new Cliente();

    $cli->id            =$_POST['id'];
    $cli->first_name    =$_POST['first_name'];
    $cli->last_name     =$_POST['last_name'];
    $cli->email         =$_POST['email'];	
    $cli->gender        =$_POST['gender'];
    $cli->ip_address    =$_POST['ip_address'];
    $cli->telefono      =$_POST['telefono'];
    if ( $db->modCliente($cli) ){
        $_SESSION['msg'] = " El usuario ha sido modificado ";
        $imageMessage='.';
        switch (uploadImage($_FILES['profileImage'],$cli->id)) {
            case NO_FILE_UPLOADED:
                $imageMessage="\n No ha selecionado ninguna imagen de perfil";
                break;

            case INVALID_FILE_TYPE:
                $imageMessage="\n La imagen no cumple con los requerimientos necesarios";
                break;

            case UPLOAD_SUCCESS:
                $imageMessage="\n Imagen subida con exito";
                break;
        }
        $_SESSION['msg'] .= " ".$imageMessage;
    } else {
        $_SESSION['msg'] = " Error al modificar el usuario ";
    }
    
}
