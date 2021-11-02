<?php

    class Partidos{

        private $id,$name,$acronym,$logo,$colour;

        public function __construct($id, $name, $acronym, $logo, $colour){
            $this->id = $id;
            $this->name = $name;
            $this->acronym = $acronym;
            $this->logo = $logo;
            $this->colour = $colour;
        }


        public function getId(){
            return $this->id;
        }


        public function setId($id){
            $this->id = $id;
            return $this;
        }


        public function getName(){
            return $this->name;
        }


        public function setName($name){
            $this->name = $name;
            return $this;
        }


        public function getAcronym(){
            return $this->acronym;
        }


        public function setAcronym($acronym){
            $this->acronym = $acronym;
            return $this;
        }

        public function getLogo(){
            return $this->logo;
        }


        public function setLogo($logo){
            $this->logo = $logo;
            return $this;
        }

        public function getColour(){
            return $this->colour;
        }


        public function setColour($colour){
            $this->colour = $colour;
            return $this;
        }



    }

?>