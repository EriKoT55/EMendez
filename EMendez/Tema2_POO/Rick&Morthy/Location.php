<?php

class Location{

    private $id,$name,$type,$dimension,$created,$residents;


    public function __construct($id, $name, $type, $dimension, $created, array $residents){
        $this->id = $id;
        $this->name = $name;
        $this->type = $type;
        $this->dimension = $dimension;
        $this->created = $created;
        $this->residents = $residents;
    }

    //Setters
    public function setName($name){
        $this->name = $name;
    }

   //Getters
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getType(){
        return $this->type;
    }
    public function getDimension(){
        return $this->dimension;
    }
    public function getCreated(){
        return $this->created;
    }
    public function getResidents(){
        return $this->residents;
    }



}

?>