<?php
$seed = 3702; //TODO: LAST 4 NUMBERS OF YOUR DNI.
$api_url = "https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?seed=" . $seed . "&data=";

$characters = json_decode(file_get_contents($api_url . "characters"), true);
$episodes = json_decode(file_get_contents($api_url . "episodes"), true);
$locations = json_decode(file_get_contents($api_url . "locations"), true);
var_dump($characters);

class Character{

    public $id, $name, $status, $species, $type, $gender, $origin, $location, $image, $created, $episodes;

    //Metodos
    function setCharacter($id, $name, $status, $species, $type, $gender, $origin, $location, $image, $created, $episodes){//me da los valores

        $this->id=$id;
        $this->name=$name;
        $this->status=$status;
        $this->species=$species;
        $this->type=$type;
        $this->gender=$gender;
        $this->origin=$origin;
        $this->location=$location;
        $this->image=$image;
        $this->created=$created;
        $this->episodes=$episodes;

    }
    function getCharacter(){// me recoge los valores

        return $this->id;
        return $this->name;
        return $this->status;
        return $this->species;
        return $this->type;
        return $this->gender;
        return $this->origin;
        return $this->location;
        return $this->image;
        return $this->created;
        return $this->episodes;

    }

}

$personajes = new rickmorthy2();//objeto vacio

for($i=0;i<count($personajes);$i++){

    $personajes[$i]->setCharacters[$characters[$i]];

}

?>