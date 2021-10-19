<?php

$contents_cities = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=cities");
$cities = json_decode($contents_cities, true);
$contents_countries = file_get_contents("https://dawsonferrer.com/allabres/apis_solutions/world.php?data=countries");
$countries = json_decode($contents_countries, true);
// tengo que asociar el country code con el otro country code nombre de country en cities crear un nuevo array
// debo crear una nueva columna que se llame country name que haga referencia countri code(cities) y contry code(countris)
function mapCities()
{
    //TODO: Your code here

}
// asignar las ciudades que estan dentro de su pais,
function mapCountries()
{
    //TODO: Your code here

}

var_dump(mapCities());
var_dump(mapCountries());