<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        .emoji{
            font-size: 70px;
        }
         
    </style>
    <title>Piedra, papel, tijera</title>
</head>
<body>
    <?php

    define ('PIEDRA1',  "&#x1F91C;");
    define ('PIEDRA2',  "&#x1F91B;");
    define ('TIJERAS',  "&#x1F596;");
    define ('PAPEL',    "&#x1F91A;" );

    $possibleAssignments =array(
        "PIEDRA1" => PIEDRA1,
        "PIEDRA2" => PIEDRA2,
        "TIJERAS" => TIJERAS,
        "PAPEL" => PAPEL
    );
    

    $player1 =random_int(0,2);
    $player2 =random_int(0,2);

    $playerValue1="";
    $playerValue2="";
    
    $isSecond=false;

    function assignedValue( $player, & $value,& $Boolean,$arrayOfOptions){
    
        if($player==0){

            if($Boolean==false){

                $value = $arrayOfOptions['PIEDRA1'];
                
            }else{

                $value = $arrayOfOptions['PIEDRA2'];
                
            }

        }elseif($player==1){

            $value = $arrayOfOptions['TIJERAS'];

        }else{

            $value = $arrayOfOptions['PAPEL'];

        }

        $Boolean=true;

        
    }

    function whoHasWon($player1,$player2,$arrayOfOptions){

        if($player1==$player2 or $player1==$arrayOfOptions['PIEDRA1'] and $player2==$arrayOfOptions['PIEDRA2']){

            return "¡Empate !";

        }elseif($player1==PAPEL and $player2==$arrayOfOptions["PIEDRA2"] or $player1==$arrayOfOptions["TIJERAS"] and $player2==$arrayOfOptions["PAPEL"] or $player1==$arrayOfOptions["PIEDRA1"] and $player2==$arrayOfOptions["TIJERAS"]){

            return "Ha ganado el jugador 1";

        }else{
            
            return "Ha ganado el jugador 2";

        }


    }

    assignedValue($player1,$playerValue1,$isSecond,$possibleAssignments);
    assignedValue($player2,$playerValue2,$isSecond,$possibleAssignments);

    ?>
    <h1>¡Piedra, papel, tijera!</h1>
    Actualice la página para mostrar otra paritda<br><br>
    <table>
        <tr>
            <th>Jugador1</th>
            <th>Jugador2</th>
        </tr>
            <th class="emoji"><?= $playerValue1;?></th>
            <th class="emoji"> <?= $playerValue2;?></th>
        <tr>
            <th colspan="2"><?= whoHasWon($playerValue1,$playerValue2,$possibleAssignments)?></th>
        </tr>
    </table>
    
    
   

</body>
</html>
