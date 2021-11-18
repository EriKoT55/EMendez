<?php

require("Character.php");
require("Episode.php");
require("Location.php");
require("BD.php");

$seed = 3702; //TODO: LAST 4 NUMBERS OF YOUR DNI.
$api_url = "https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?seed=" . $seed . "&data=";

$characters = json_decode(file_get_contents($api_url . "characters"), true);
$episodes = json_decode(file_get_contents($api_url . "episodes"), true);
$locations = json_decode(file_get_contents($api_url . "locations"), true);

/*
    echo "<br>";
    echo "<pre>";
    var_dump($locations);
    echo "</pre>";
*/

function getSortedCharactersById($characters)
{
    //TODO: Your code here.

    for($i=0;$i<count($characters);$i++){
        for($j=0;$j<count($characters);$j++){

            if($characters[$i]["id"]<$characters[$j]["id"]){

                $aux=$characters[$i];
                $characters[$i]=$characters[$j];
                $characters[$j]=$aux;

            }

        }
    }
    return $character;
}

function getSortedCharactersByOrigin($characters)
{
    //TODO: Your code here.
    for($i=0;$i<count($characters);$i++){
        for($j=0;$j<count($characters);$j++){

            if($characters[$i]["origin"]<$characters[$j]["origin"]){

                $aux=$characters[$i];
                $characters[$i]=$characters[$j];
                $characters[$j]=$aux;

            }

        }
    }
    return $characters;
    /*echo "<br>";
    echo "<pre>";
    var_dump($characters);
    echo "</pre>";*/
}

function getSortedCharactersByStatus($characters)
{
    //TODO: Your code here.
    for($i=0;$i<count($characters);$i++){
        for($j=0;$j<count($characters);$j++){

            if($characters[$i]["status"]<$characters[$j]["status"]){

                $aux=$characters[$i];
                $characters[$i]=$characters[$j];
                $characters[$j]=$aux;

            }

        }
    }
    return $characters;
}

//Clases

function createCharacter(){
    global $characters;

    for($i=0;$i<count($characters);$i++){

        $characters[$i]=new Character($characters[$i]["id"],$characters[$i]["name"],$characters[$i]["status"],
            $characters[$i]["species"],$characters[$i]["type"],$characters[$i]["gender"],$characters[$i]["origin"],
            $characters[$i]["location"],$characters[$i]["image"],$characters[$i]["created"],$characters[$i]["episodes"]);

    }
    return $characters;
}

//NOTE: OPTIONAL FUNCTION
function getSortedLocationsById($locations)
{
    //TODO: Your code here.
    for($i=0;$i<count($locations);$i++){
        for($j=0;$j<count($locations);$j++){

            if($locations[$i]["id"]<$locations[$j]["id"]){

                $aux=$locations[$i];
                $locations[$i]=$locations[$j];
                $locations[$j]=$aux;

            }

        }
    }
    return $locations;
}

//NOTE: OPTIONAL FUNCTION
function getSortedEpisodesById($episodes)
{
    //TODO: Your code here.
    for($i=0;$i<count($episodes);$i++){
        for($j=0;$j<count($episodes);$j++){

            if($episodes[$i]["id"]<$episodes[$j]["id"]){

                $aux=$episodes[$i];
                $episodes[$i]=$episodes[$j];
                $episodes[$j]=$aux;

            }

        }
    }
    return $episodes;
}

function mapCharacters($characters)
{
    //TODO: Your code here.
    global $sortedLocations;
    global $sortedEpisodes;

    for($j=0;$j<count($sortedLocations);$j++){//15
        for($i=0;$i<count($characters);$i++){

            if($characters[$i]["origin"] == $sortedLocations[$j]["id"]){

                $characters[$i]["origin"]=$sortedLocations[$j]["name"];

            }else if ($characters[$i]["origin"]=="0"){
                $characters[$i]["origin"]="Unknown";
            }

        }



    }
        echo "<br>";
        echo "<pre>";
        var_dump($characters);
        echo "</pre>";

}

$sortedLocations = getSortedLocationsById($locations);
$sortedEpisodes = getSortedEpisodesById($episodes);
$mappedCharacters = mapCharacters($characters);

mapCharacters($characters)

?>