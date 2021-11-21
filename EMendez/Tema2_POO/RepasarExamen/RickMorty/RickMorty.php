<?php
$seed = 3702; //TODO: LAST 4 NUMBERS OF YOUR DNI.
$api_url = "https://dawsonferrer.com/allabres/apis_solutions/rickandmorty/api.php?seed=" . $seed . "&data=";

require("Character.php");
require("Episode.php");
require("Location.php");

//NOTE: Arrays unsorted
$characters = json_decode(file_get_contents($api_url . "characters"), true);
$episodes = json_decode(file_get_contents($api_url . "episodes"), true);
$locations = json_decode(file_get_contents($api_url . "locations"), true);

/*
echo "<br>";
echo "<pre>";
echo  var_dump($characters);
echo "<br>";
*/
//*********************************************
//Pasar arrays a objetos

$characters_obj=[];
foreach ($characters as $character){

$characters_obj[]=new Character($character["id"],$character["name"],$character["status"],
    $character["species"],$character["type"],$character["gender"],$character["origin"],
    $character["location"],$character["image"],$character["created"],$character["episodes"]);

}

$episodes_obj=[];
foreach ($episodes as $episode){

$episodes_obj[]= new Episode($episode["id"],$episode["name"],$episode["air_date"],
    $episode["episode"],$episode["created"],$episode["characters"]);

}

$locations_obj=[];
foreach($locations as $location){

$locations_obj[]=new Location($location["id"],$location["name"],$location["type"],
    $location["dimension"],$location["created"],$location["residents"]);

}

//*********************************************

function ordenarPorID(){
    global $characters_obj;

    for($i=0;$i<count($characters_obj);$i++){
        for($j=$i;$j<count($characters_obj);$j++){
            if($characters_obj[$i]>$characters_obj[$j]){

                $aux=$characters_obj[$i];
                $characters_obj[$i]=$characters_obj[$j];
                $characters_obj[$j]=$aux;

            }
        }
    }

    return $characters_obj;

}

function ordenarPorOrigin(){
    global $characters_obj;

    for($i=0;$i<count($characters_obj);$i++){
        for($j=$i;$j<count($characters_obj);$j++){
            if($characters_obj[$i]->getOrigin()>$characters_obj[$j]->getOrigin()){

                $aux=$characters_obj[$i];
                $characters_obj[$i]=$characters_obj[$j];
                $characters_obj[$j]=$aux;

            }
        }
    }

    echo "<br>";
    echo "<pre>";
    echo  var_dump($characters_obj);
    echo "<br>";

}


$sortingCriteria = "";
if (isset($_GET["sortingCriteria"])) {
$sortingCriteria = $_GET["sortingCriteria"];
    switch($sortingCriteria){

        case "id":
            //$characters=/*Poner aqui funcion que ordena por id*/;
            break;
        //case...

    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FIESTA DE RICK&MORTHY</title>
</head>
<body>

<form action="RickMorty.php">
    <label for="sortingCriteria">Elige una de las opciones:</label>
    <select aria-label="Sorting criteria" name="sortingCriteria">
        <option <?php echo($sortingCriteria == "id" ? "selected" : "") ?> value="id">Ordenado por ID</option>
        <option <?php echo($sortingCriteria == "origin" ? "selected" : "") ?> value="origin">Ordenado por origin</option>
        <option <?php echo($sortingCriteria == "status" ? "selected" : "") ?> value="status">Ordenado por status</option>
    </select>
    <input type="submit" value="Sort">
</form>

<?php

ordenarPorOrigin();

?>
</body>
</html>
