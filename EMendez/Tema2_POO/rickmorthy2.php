<?php
$seed = 3702; //TODO: LAST 4 NUMBERS OF YOUR DNI.
$api_url = "https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?seed=" . $seed . "&data=";

$characters = json_decode(file_get_contents($api_url . "characters"), true);
$episodes = json_decode(file_get_contents($api_url . "episodes"), true);
$locations = json_decode(file_get_contents($api_url . "locations"), true);

// Mapea en la clase de personajes: origin, location y episodes, pero en vez de con array con objetos

class Character{

    public $id, $name, $status, $species, $type, $gender, $origin, $location, $image, $created, $episodes;

    //Metodos setters y getters

    public function __construct($id, $name, $status, $species, $type, $gender, $origin, $location, $image, $created, $episodes){
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

    // Setters
    public function setID($id){// introduzco valores
        $this->id=$id;
    }
    public function setName($name){
        $this->name=$name;
    }
    public function setStatus($status){
        $this->status=$status;
    }
    public function setSpecies($species){
        $this->species=$species;
    }
    public function setType($type){
        $this->type = $type;
    }
    public function setGender($gender){
        $this->gender = $gender;
    }
    public function setOrigin($origin){
        $this->origin = $origin;
    }
    public function setLocation($location){
        $this->location = $location;
    }
    public function setImage($image){
        $this->image = $image;
    }
    public function setCreated($created){
        $this->created = $created;
    }
    public function setEpisodes($episodes){
        $this->episodes = $episodes;
    }

    // Getters
    public function getId(){//Devuelve valores
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


$personajes=[]; //Creado objeto vacio

for($i=0;$i<count($characters);$i++){

    $personajes[$i]->setID($characters[$i]["id"]);
    $personajes[$i]->setName($characters[$i]["name"]);
    $personajes[$i]->setStatus($characters[$i]["status"]);
    $personajes[$i]->setSpecies($characters[$i]["species"]);
    $personajes[$i]->setType($characters[$i]["type"]);
    $personajes[$i]->setGender($characters[$i]["gender"]);
    $personajes[$i]->setOrigin($characters[$i]["origin"]);
    $personajes[$i]->setLocation($characters[$i]["location"]);
    $personajes[$i]->setImage($characters[$i]["image"]);
    $personajes[$i]->setCreated($characters[$i]["created"]);
    $personajes[$i]->setEpisodes($characters[$i]["episodes"]);

    var_dump($personajes[$i]);
}

?>