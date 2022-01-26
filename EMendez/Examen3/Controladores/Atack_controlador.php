<?php
require_once ("../Modelos/Main_modelo.php");
session_start();

$conn= new Main_modelo();

/****  JUEGO  ****/
$code=$_GET["Code"];
if(isset($code)) {
    $countriesATK = $conn->getCountryATK( $code );
}

//DEVUELVE EL OBJETO PAIS DEL USUARIOID, DADO ALEATORIAMENTE
$countryObjArr=$conn->getCountryUsr($_SESSION["userID"]);

//DEVUELVE LOS OBJETOS PAISES
$countriesObjArr=$conn->getCountries();

// DAÑO DEL PAIS ATACADO
$fuerzaNPC=$countriesATK[0]->getPopulation()+$countriesATK[0]->getGNP();

// DAÑO DEL USUARIO
$poblacion= $conn->getCountryUsr($_SESSION["userID"])[0]->getPopulation();
$gnp= $conn->getCountryUsr($_SESSION["userID"])[0]->getGNP();
$fuerzaUser=$poblacion+$gnp;

/** DARLE UNA VUELTA
 * COMO QUITAR EL PAIS VENCIDO DE LA TABLA Y PASARLO A LA DEL USUARIO
 * DEBO TENER MENOS FUNCIONES Y UNIR ALGUNA PARA QUE SE APLIQUEN LOS CAMBIOS
 */
if($fuerzaUser>$fuerzaNPC){
    //$countriesATK[0]->setUserid($_SESSION["userID"]);
    echo "ganaste";
}else{
    echo "ERES BIEN PUTO";
}

require_once ("../Vistas/Main_vista.php");
?>