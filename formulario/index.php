<?php

    define("LISTELEMENTS",["name","alias","age","weapons","practice"]);
    define("FOLDERPATH","uploads");

    //En caso de ser la petición por get nos mostrara el formulario si no nos procesará los datos
    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        include_once 'captura.html';
    }else{
        $userData=validateForm(LISTELEMENTS);
        $validateFile=validateImage(FOLDERPATH);
        if($userData!=null){
            $outputData=showdata($userData,$validateFile,FOLDERPATH);
        } 
    }

    
    function validateForm($valuesSearch){

        $isValidData=true;
        $playerData=[];

        foreach($valuesSearch as $value){
            //Valida que se hayan enviado los campos necesarios definidos dentro de la constante LISTELEMENTS
            isset($_REQUEST[$value]) ? $playerData[$value] = $_REQUEST[$value] : $isValidData=false;
        }
    
        if($isValidData==true){
            //quita los espacios en blanco que pueda ver y elimina posibles etiquetas que puedan modificar el comportamiento 
            //de la página además de validar que el valor sea del tipo de campo que se solicita en las tres situaciones
            $playerData['name']=trim(strip_tags($playerData['name']));
            if(!is_string($playerData['name']) || $playerData['name']==""){
                $isValidData=false;
            }

            $playerData['alias']=trim(strip_tags($playerData['alias']));
            if(!is_string($playerData['alias']) || $playerData['alias']==""){
                $isValidData=false;
            }

            $playerData['age']=trim(strip_tags($playerData['age']));
            if(!is_numeric($playerData['age'])){ 
                $isValidData=false;
            }
        }
        //En caso de que los datos introducidos no sean correctos o los requeridos se le mostrara al usuaio un mensaje de error
        //y un boton para volver en el caso de que todo este bien devolverá un array con los datos del formulario
        if ($isValidData == false) {
            echo "<h1>Invalid data</h1><br>";
            echo "<button onclick='window.history.back();'>Volver</button>";
        } else {
            return $playerData;
        }
    }

    function validateImage($folder){
        //En caso de que error sea igual a 4 significara que el usuario no habrá selecionado ningún archivo con lo cual devolvera 3
        if($_FILES['imageuplo']['error']!=4){
            //Valida si el tamaño y extension son correctos, además tendra en cuenta que si erro es igual a 2 en la parte cliente
            //ha dado un error de tamaño y no se ha enviado devolvería 2
            //En caso de estar todo correcto lo guarda en la carpeta que hemos definido en la cosntante FOLDERPATH y devuelve un 1
            $maxFileSize = 10000;
            if ($_FILES['imageuplo']['type'] != 'image/png' || $_FILES['imageuplo']['size'] > $maxFileSize || $_FILES['imageuplo']['error']==2) {
                return 2;
            } else {
                $tempFile = $_FILES['imageuplo']['tmp_name'];
                $fileName = $_FILES['imageuplo']['name'];
                move_uploaded_file($tempFile, $folder . '/' . $fileName);
                return 1;
            }
        }
        return 3;
    }

    function showData($data,$code,$folderPath){

        $error="";
        $weaponsShow="";

        if($code==1){
            $infoImage="Imagen Subida:";
            $imageShown=$folderPath."/".$_FILES['imageuplo']['name'];
        }elseif($code==2){
            $infoImage="No se subió ninguna imagen.";
            $imageShown="calavera.png";
            $error="Error al subir una imagen";
        }else{
            $infoImage="No se subió ninguna imagen.";
            $imageShown="calavera.png";
        }
        //En weapons se almacena un array, se reccore el array y por cada posicion que no sea la última se le añade una coma en caso contrario no se añade nada
        $arrayOfWeapons=$data['weapons'];
        $weaponLastPosition=end($arrayOfWeapons);
        foreach($arrayOfWeapons as $weapons){
            $weaponsShow.=$weapons;
            if($weapons!=$weaponLastPosition){
                $weaponsShow.=", ";
            }
        }

        return "    <div class='playertab'>
        <h2><b>Datos del Jugador</b></h2>

        <table class='table1'>
            <tr>
                <td></td>
            </tr>
            <tr>
                <td><b>Nombre: </b>".$data['name']."</td>
            </tr>
            <tr>
                <td><b>Alias: </b>".$data['alias']."</td>
            </tr>
            <tr>
                <td><b>edad: </b>".$data['age']."</td>
            </tr>
            <tr>
                <td><b>Armas seleccionadas: </b>".$weaponsShow."</td>
            </tr>
            <tr>
                <td><b>¿Practica artes mágicas?: </b>".$data['practice']."</td>
            </tr>
        </table>

        <table class='table2'>
            <tr>
                <th>".$infoImage."</th>
            </tr>
            <tr>
                <td><img src='".$imageShown."' alt='imagen del Jugador'></td>
            </tr>
            <tr>
                <td>".$error."</td>
            </tr>
            </table>
    </div>
";
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formstyles.css">
    <title>Ficha de Jugador</title>
</head>
<body>
<?=$outputData?>
</body>
</html>