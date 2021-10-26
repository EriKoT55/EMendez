<?php
$seed = 3702; //TODO: LAST 4 NUMBERS OF YOUR DNI.
$api_url = "https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?seed=" . $seed . "&data=";

$characters = json_decode(file_get_contents($api_url . "characters"), true);
$episodes = json_decode(file_get_contents($api_url . "episodes"), true);
$locations = json_decode(file_get_contents($api_url . "locations"), true);


// Mapea en la clase de personajes: origin, location y episodes, pero en vez de con array con objetos

function getSortedLocationsById($locations){
    //TODO: Your code here.

    for($i=0;$i<count($locations);$i++){
        for($j=0;$j<count($locations);$j++){

            if($locations[$i]['id']<$locations[$j]['id']){

                $aux=$locations[$i];
                $locations[$i]=$locations[$j];
                $locations[$j]=$aux;

            }

        }
    }

    return $locations;

}

//NOTE: OPTIONAL FUNCTION
function getSortedEpisodesById($episodes){
    //TODO: Your code here.

    for($i=0;$i<count($episodes);$i++){
        for($j=0;$j<count($episodes);$j++){

            if($episodes[$i]['id']<$episodes[$j]['id']){

                $aux=$episodes[$i];
                $episodes[$i]=$episodes[$j];
                $episodes[$j]=$aux;

            }

        }
    }

    return $episodes;

}



function mapCharacters($characters){
    //TODO: Your code here.

    global $sortedLocations;
    global $sortedEpisodes;

    // mapping origin
    for($i=0;$i<count($sortedLocations);$i++){
        for($j=0;$j<count($characters);$j++){

            if($characters[$j]["origin"]==$sortedLocations[$i]["id"]){

                $characters[$j]["origin"]=$sortedLocations[$i]["name"];

            }

        }
    }


    //mapping location
    for($i=0;$i<count($sortedLocations);$i++){
        for($j=0;$j<count($characters);$j++){
            if($characters[$j]["location"]==$sortedLocations[$i]["id"]){

                $characters[$j]["location"]=$sortedLocations[$i]["name"];

            }
        }
    }

    // maping episodios, no funciona.
    /*for($i=0;$i<count($sortedEpisodes);$i++){
        for($j=0;$j<count($sortedEpisodes);$j++){
            if($characters[$j]["episodes"][0]==$sortedEpisodes[$i]["id"]){

                $characters[$j]["episodes"][0]=$sortedEpisodes[$i]["name"];

            }
        }
    }*/


    return $characters;


}
$sortedLocations = getSortedLocationsById($locations);
$sortedEpisodes = getSortedEpisodesById($episodes);
$mappedCharacters = mapCharacters($characters);

class Character{

    private $id, $name, $status, $species, $type, $gender, $origin, $location, $image, $created, $episodes;

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


$personajes=[]; //Creado array

for($i=0;$i<count($characters);$i++){
        // Creo objeto e introduzco los valores
    $personajes[$i]=new Character($mappedCharacters[$i]["id"],$mappedCharacters[$i]["name"],$mappedCharacters[$i]["status"],$mappedCharacters[$i]["species"],$mappedCharacters[$i]["type"],$mappedCharacters[$i]["gender"],$mappedCharacters[$i]["origin"],$mappedCharacters[$i]["location"],$mappedCharacters[$i]["image"],$mappedCharacters[$i]["created"],$mappedCharacters[$i]["episodes"]);

}

echo "<br>";
echo "<pre>";
var_dump($personajes);
echo "</pre>";

?>