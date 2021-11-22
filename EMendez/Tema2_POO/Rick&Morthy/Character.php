<?php

class Character{

    private $id, $name, $status, $species, $type, $gender, $origin, $location, $image, $created, $episodes;


    public function __construct($id, $name, $status, $species, $type, $gender, $origin, $location, $image, $created, array $episodes){
        $this->id = $id;
        $this->name = $name;
        $this->status = $status;
        $this->species = $species;
        $this->type = $type;
        $this->gender = $gender;
        $this->origin = $origin;
        $this->location = $location;
        $this->image = $image;
        $this->created = $created;
        $this->episodes = $episodes;
    }

    //Setters
    public function setOrigin($origin){
        $this->origin = $origin;
    }
    public function setLocation($location){
        $this->location = $location;
    }
    public function setEpisodes($episodes){
        $this->episodes = $episodes;
    }

    //Getters
    public function getId(){
        return $this->id;
    }
    public function getName(){
        return $this->name;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getSpecies(){
        return $this->species;
    }
    public function getType(){
        return $this->type;
    }
    public function getGender(){
        return $this->gender;
    }
    public function getOrigin(){
        return $this->origin;
    }
    public function getLocation(){
        return $this->location;
    }
    public function getImage(){
        return $this->image;
    }
    public function getCreated(){
        return $this->created;
    }
    public function getEpisodes(){
        return $this->episodes;
    }



}

?>