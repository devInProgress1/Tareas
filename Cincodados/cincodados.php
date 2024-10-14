<?php include_once 'cincodadosback.php'?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

        tr:nth-child(odd) .emoji{
            background-color:red;
            font-size: 70px;
        }
        tr:nth-child(even) .emoji{
            background-color:blue;
            font-size: 70px;
        }
         
    </style>
    <title>Document</title>
</head>
<body>
    <h1>Cinco dados</h1>
    <p>Actualize la página para mostrar una nueva tirada</p>
    <table>
        <?php for($times=0;$times<$numberOfPlayers;$times++):?>

        <tr>
            <th>jugador <?php echo $times+1?></th>
            <td class="emoji"><?= fiveDiceRolls($dicePossibleValue,$diceRolls) ?></td>
            <th><?=playerPoints($diceRolls,$playersPoints)?> puntos</th>
        </tr>
        
        <?php endfor; ?>
    </table>
    <b>Resultado</b><?=whoHasWon($playersPoints)?>
</body>
</html>
