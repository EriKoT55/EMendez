<?php

class Provincias{

    private $nombre,$poblacion,$N_Diputados;



    public function __construct($nombre, $poblacion, $N_Diputados){
        $this->nombre = $nombre;
        $this->poblacion = $poblacion;
        $this->N_Diputados = $N_Diputados;
    }


    public function getNombre(){
        return $this->nombre;
    }
    public function setNombre($nombre){
        $this->nombre = $nombre;
        return $this;
    }
    public function getPoblacion(){
        return $this->poblacion;
    }
    public function setPoblacion($poblacion){
        $this->poblacion = $poblacion;
        return $this;
    }
    public function getNDiputados(){
        return $this->N_Diputados;
    }
    public function setNDiputados($N_Diputados){
        $this->N_Diputados = $N_Diputados;
        return $this;
    }



}

?>