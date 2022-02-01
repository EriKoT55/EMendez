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

// DAÑO DEL PAIS ATACADOS
$fuerzaNPC=$countriesATK[0]->getPopulation()+$countriesATK[0]->getGNP();

// DAÑO DEL USUARIO
$userCountries=$conn->getCountryUsr($_SESSION["userID"]);
$fuerzaUser=0;
$poblacion=0;
$gnp=0;
foreach($userCountries as $userCountry) {
    $poblacion+= $userCountry->getPopulation();
    $gnp+= $userCountry->getGNP();
}
$fuerzaUser=$poblacion+$gnp;

if($fuerzaUser>$fuerzaNPC){
    //$countriesATK[0]->setUserid($_SESSION["userID"]);
    if($conn->winAttack($code,$_SESSION["userID"])) {

        echo "ganaste";
    }
}else{
    echo "ERES BIEN PUTO";
}

require_once ("../Vistas/Main_vista.php");
?>