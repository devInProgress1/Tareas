<?php

class bicicletaElectrica {

    private $id; // Identificador de la bicicleta (entero)
    private $coordx; // Coordenada X (entero)
    private $coordy; // Coordenada Y (entero)
    private $bateria; // Carga de la batería en tanto por ciento (entero)
    private $operativa; // Estado de la bicleta ( true operativa- false no disponible)


    function __get($name) {
        return $this->$name;
    }

    function __set($name, $value) {
        $this->$name=$value;
    }

    function __ToString() {
        return "Identificador: ".$this->id." Bateria ".$this->bateria." %";
    }

    function distancia($coordx,$coordy){
       return sqrt(pow(($coordx-$this->coordx),2)+pow(($coordy-$this->coordy),2));
    }
}