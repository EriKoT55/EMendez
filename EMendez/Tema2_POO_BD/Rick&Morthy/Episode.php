<?php

class Episode{

    private $id,$name,$air_date,$episode,$created,$characters;

    public function __construct($id, $name, $air_date, $episode, $created, array $characters){
        $this->id = $id;
        $this->name = $name;
        $this->air_date = $air_date;
        $this->episode = $episode;
        $this->created = $created;
        $this->characters = $characters;
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

    public function getAirDate(){

        return $this->air_date;
    }
    public function getEpisode(){
        return $this->episode;
    }
    public function getCreated(){
        return $this->created;
    }
    public function getCharacters(){
        return $this->characters;
    }



}

?>