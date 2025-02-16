<?php

function validateData($ip,$phone,$email,$id=null) {
    if(!filter_var($ip,FILTER_VALIDATE_IP)){
        return "La IP no es correcta";
    }
    if(!preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone)){
        return "Formato de número incorrecto";
    }
    $db = AccesoDatos::getModelo();
    $isRepeated = $id !=null ? $db->uniqueEmailExistingUser($email,$id)==0:$db->uniqueEmail($email)==0;
    if(!$isRepeated){
        return "Email incorrecto";
    }
        
    return;
}