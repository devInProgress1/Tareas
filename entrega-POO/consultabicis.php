<?php
include_once 'BiciElectrica.php';

const BICYCLES="Bicis.csv";

function cargabicis(){
    $data = fopen(BICYCLES,"r");
    $bikes=[];
    while(($bicycle = fgetcsv($data))!==false) {
        $actualBike= new bicicletaElectrica();
        $actualBike->operativa=$bicycle[4];
        //Si la bici esta operativa almacena todos las propiedades del objeto en un array
        if($actualBike->operativa==1) {
            $actualBike->id=$bicycle[0];
            $actualBike->coordx=$bicycle[1];
            $actualBike->coordy=$bicycle[2];
            $actualBike->bateria=$bicycle[3];
            $bikes[]= $actualBike;
        }
    }
    fclose($data);
    return $bikes;
}

function mostrartablabicis($bikes) {
    $table='<table>';
    $table.= "<tr>";
    $table.= "<td>id</td><td>Coord X</td><td>Coord Y</td><td>Bateria</td>";
    $table.="</tr>";
    foreach ($bikes as $value) {
        $table.= "<tr>";
        $table.= "<td>"."$value->id"."</td><td>"."$value->coordx"."</td><td>"."$value->coordy"."</td><td>"."$value->bateria"."</td>";
        $table.="</tr>";
    }
    $table.= "</table>";
    return $table;
}

function bicimascercana($coordX,$coordY,$bikes) {
    $minDistance = null;
    $minDistanceObjt ="";
    foreach ($bikes as $value) {
        //Calcula la distancia utilizando la formula de calculo de distancias
        $distance=$value->distancia($coordX,$coordY);
        if($distance<$minDistance || $minDistance===null) {
            $minDistance=$distance;
            $minDistanceObjt = $value;
        }
    }
    return $minDistanceObjt;
}

$tabla = cargabicis();
if (!empty($_GET['coordx']) && !empty($_GET['coordy'])) {
$biciRecomendada = bicimascercana($_GET['coordx'], $_GET['coordy'], $tabla);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bicis Operativas</title>
    <style>
        table, th, td {
        border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>Listado de bicicletas operativas</h1>
    <?=mostrartablabicis($tabla)?>

    <?php if (isset($biciRecomendada)) : ?>
        <h2> Bicicleta disponible más cercana es <?= $biciRecomendada ?> </h2>
        <button onclick="history.back()"> Volver </button>
    <?php else : ?>
        <h2> Indicar su ubicación: <h2>
        <form>
        Coordenada X: <input type="number" name="coordx"><br>
        Coordenada Y: <input type="number" name="coordy"><br>
        <input type="submit" value=" Consultar ">
        </form>
    <?php endif ?>
</body>
</html>