<?php

$contents_cities = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=cities");
$cities = json_decode($contents_cities, true);
$contents_countries = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=countries");
$countries = json_decode($contents_countries, true);
// tengo que asociar el country code con el otro country code nombre de country en cities crear un nuevo array
// debo crear una nueva columna que se llame country name que haga referencia countri code(cities) y contry code(countris)
function mapCities($countries,$cities){
    //TODO: Your code here

    for($i=0;$i<count($countries);$i++){
        for($j=0;$j<count($cities);$j++){
            if($countries[$i]["Code"]==$cities[$j]["CountryCode"]){
                $cities[$j]["Name of Country"]=$countries[$i]["Name"];
            }
        }
    }
    echo "<br>";
    echo "<pre>";
    return $cities;
    echo "</pre>";
}
// asignar las ciudades que estan dentro de su pais,
function mapCountries($countries,$cities){
    //TODO: Your code here

    for($i=0;$i<count($cities);$i++){
        for($j=0;$j<count($countries);$j++){

            if($countries[$j]["Code"]==$cities[$i]["CountryCode"]){

                        $countries[$j]["Cities"][]=$cities[$i]["Name"];

            }

        }
    }

    echo "<br>";
    echo "<pre>";
    return $countries;
    echo "</pre>";

}

var_dump(mapCities($countries,$cities));
var_dump(mapCountries($countries,$cities));
?>