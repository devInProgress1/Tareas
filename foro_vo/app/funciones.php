<?php
function usuarioOk($usuario, $contraseña) :bool {
   return (strlen($usuario)>=8 && $usuario==strrev($contraseña));
}

function userInputFormat($input) :string {
   $input=trim(htmlentities($input));
   return($input); 
}

//Se cuentan las palabras de los comentarios
function wordCount($commentary){
    $countWords = 0;
    $isWord = false;

    //por defecto isWord es falso y en caso de que currentChar deje de ser espacio 
    //se paasra a isWord a true y se le sumara a countWord uno y se seguira ejecutando
    //hasta volver a encontrar un espacio en cuyo caso se volvería a poner isWord a false
    for($position = 0; $position < strlen($commentary); $position++){
    $currentChar= strtolower(substr($commentary,$position,1));
        if($currentChar != ' '){
            if(!$isWord){
                $countWords++;
                $isWord = true;
            }
        }else{
            $isWord = false;
        }
    }
    return $countWords;
}

//Letra mas repetida en el comentario
function mostRepeatedLetter($commentary){
    $mostRepeatedLetter = '';
    $currentlyMostCount = 0;

    //Se extraen los caracteres uno a uno y se cuenta el numero de veces que se repite
    //y si es mayor al actual se cambia 
    for($position = 0; $position < strlen($commentary); $position++){
        $currentChar = strtolower(substr($commentary,$position,1));
        if($currentChar >= 'a' && $currentChar <= 'z'){
            $countRepeated = 0;
            for($char = 0; $char < strlen($commentary); $char++){
                $CharInString = strtolower(substr($commentary,$char,1));
                if($CharInString == $currentChar){
                    $countRepeated++;
                }
            }   
        }
        if($countRepeated > $currentlyMostCount){
            $currentlyMostCount = $countRepeated;
            $mostRepeatedLetter = $currentChar;
        }
    }

    return $mostRepeatedLetter;
}

//Se guarda en un array las palabas que conforman el comentario y se procede a 
//guardar en otro array como clave las palabras del comentario y el número de 
//veces que se repite la palabra tras terminar se muestra la clave del valor mas repetido
function mostRepeatedWord($commentary){
    $commentary = strtolower($commentary);
    $words = str_word_count($commentary, 1);
    $wordCount = [];
  
    foreach($words as $word){
        if(isset($wordCount[$word])){
            $wordCount[$word]++;
        }else{
            $wordCount[$word] = 1;
        }
    }
    $maxCount = max($wordCount);
    $mostRepeatedWord = array_search($maxCount, $wordCount);

    return $mostRepeatedWord;
}