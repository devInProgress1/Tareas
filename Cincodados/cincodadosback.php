<?php

$dicePossibleValue = ['&#9856;'/*one*/,
                      '&#9857;'/*two*/,
                      '&#9858;'/*three*/,
                      '&#9859;'/*four*/,
                      '&#9860;'/*five*/,
                      '&#9861;'/*six*/
];

$numberOfPlayers=2;

$diceRolls = [];

$playersPoints = [];

function fiveDiceRolls($arrayOfValues,&$arrayOfRolls){

    //Realiza la tirada de dados 5 veces
    for($roll=0;$roll<5;$roll++){

        $rollValue= random_int(1,6);

        //Almacena el valor resultante de la tirada en el array
        $arrayOfRolls[$roll]=$rollValue;

        //Muestra el valor del array donde estan los iconos de las posiciones de un dado
        echo $arrayOfValues[$rollValue-1];

    }
}

function playerPoints($arrayOfRolls,&$playerPoints){

    //Ordena el array
    sort($arrayOfRolls);

    $totalPoints=0;

    //Recorre el array descartando el máximo y mínimo valor
    for($roll=1;$roll<sizeof($arrayOfRolls)-1;$roll++){

        $totalPoints+=$arrayOfRolls[$roll];

    }

    //Indica el tamaño del array
    $lastPosition=sizeof($playerPoints);

    //Guarda el valor de los puntos del jugador en la última posición
    $playerPoints[$lastPosition]=$totalPoints;

    echo $totalPoints;
}

function whoHasWon($playersPoints){

    //Consigue el mayor valor del array
    $maxPoints = max($playersPoints);

    //Consigue la posicción o posiciones del mayor valor del array
    $winner = array_keys($playersPoints, $maxPoints);

    //En caso de que el array sea de un solo valor indica que hay un ganador y si hubiese mas de uno hay un empate
    if(sizeof($winner)==1){

        echo " Ha ganado el jugador ".($winner[0]+1);


    }else{

        echo " Empate";

    }
    
}

?>