<?php

function uploadImage($image,$id){

    if($image['error']==NO_FILE_UPLOADED){
        return NO_FILE_UPLOADED;
    }

    if ($image['type'] != 'image/jpg' && $image['type'] != 'image/png' || $image['size'] > MAX_FILE_SIZE || $image['error'] == UPLOAD_ERR_FORM_SIZE) {
        return INVALID_FILE_TYPE;
    }
    
    $fileName=getImageName($id);
    $tempFile = $image['tmp_name'];
    move_uploaded_file($tempFile, IMAGES_FOLDER . '/' . $fileName);
    return UPLOAD_SUCCESS;
    
}

function getImageName($id) {
    $fileName='';
    
    for ($i=0; $i < 8-mb_strlen($id); $i++) { 
        $fileName.='0';
    }
    $fileName.=$id.".jpg";
    return $fileName;

}

function getFlag ($ip){

    $ipInfo = @json_decode(file_get_contents("http://ip-api.com/json/".$ip), true);

    if ($ipInfo['status'] != 'success') {
        return false;
    }

    $info=[];
    $info[0] = "https://flagcdn.com/w320/".strtolower($ipInfo['countryCode']).".jpg";
    $info[1] = $ipInfo['country'];
    return $info;
}
