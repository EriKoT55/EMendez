<?php
require_once ("../Modelos/Main_modelo.php");

session_start();

$conn= new Main_modelo();

//RANDOMIZA EL PAIS PARA EL USUSARIO


/*
echo "<br>";
echo "<pre>";
var_dump($conn->getCountry($codeRandom));
echo "<br>";
*/

$countryObjArr=$conn->getCountry($_SESSION["userID"]);
$countriesObjArr=$conn->getCountries();

/*NO SE COMO HACERLO EN EL CONTROLADOR PARA NO TENER QUE LLAMAR A LA FUNCION EN LA VISTA
foreach ($countriesObjArr as $countries){
  $user[]=$conn->getUserT($countries->getUserid());
}
*/

require_once ("../Vistas/Main_vista.php");
?>