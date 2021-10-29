<?php

class Resultados{

    private $distrito,$partidos,$votos;


    public function __construct($distrito, $partidos, $votos){
        $this->distrito = $distrito;
        $this->partidos = $partidos;
        $this->votos = $votos;
    }


    public function getDistrito(){
        return $this->distrito;
    }
    public function setDistrito($distrito){
        $this->distrito = $distrito;
        return $this;
    }


    public function getPartidos(){
        return $this->partidos;
    }
    public function setPartidos($partidos){
        $this->partidos = $partidos;
        return $this;
    }


    public function getVotos(){
        return $this->votos;
    }
    public function setVotos($votos){
        $this->votos = $votos;
        return $this;
    }



}

?>