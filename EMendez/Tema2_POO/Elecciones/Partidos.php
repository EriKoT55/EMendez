<?php

    class Partidos{

        private $nombre,$comunidades,$votos;

        public function __construct($nombre, $comunidades, $votos){
            $this->nombre = $nombre;
            $this->comunidades = $comunidades;
            $this->votos = $votos;
        }

        public function getNombre(){
            return $this->nombre;
        }


        public function setNombre($nombre){
            $this->nombre = $nombre;
            return $this;
        }

        public function getComunidades(){
            return $this->comunidades;
        }

        public function setComunidades($comunidades){
            $this->comunidades = $comunidades;
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