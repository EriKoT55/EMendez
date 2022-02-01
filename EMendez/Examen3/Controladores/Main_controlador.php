<?php
require_once ("../Modelos/Main_modelo.php");
session_start();

//AL NO HABER INICIADO SESSION ME MANDA AL LOGIN
if(!isset($_SESSION["Iniciada"])){
    header("Location: ../Controladores/Login_controlador.php");
}

$conn=new Main_modelo();

$countries=$conn->getCountries();

$countriesUsr=$conn->getCountryUser($_SESSION["userID"]);

if($_GET["Ataque"]!="") {
    if( isset( $_GET["Ataque"] )==true ) {

        if( isset( $_GET["Code"] ) ) {
            $countriesAtacado = $conn->getCountryNPC( $_GET["Code"] );
        }

        $population=0;
        $gnp=0;
        foreach($countriesUsr as $countryUsr){

            $population+=$countryUsr->getPopulation();
            $gnp+=$countryUsr->getGNP();
        }

        $fuerzaUsr=$population+$gnp;

        $populationNPC=$countriesAtacado[0]->getPopulation();
        $gnpNPC=$countriesAtacado[0]->getGNP();

        $fuerzaNPC=$populationNPC+$gnpNPC;

        if($fuerzaUsr>$fuerzaNPC){
            $conn->countryATK($_SESSION["userID"],$_GET["Code"]);
        }else{
            echo "pierdes";
        }

    }
}
//PARA QUE SE ACTUALICE LA LOS PAISES DEL USUARIO
$countriesUsr=$conn->getCountryUser($_SESSION["userID"]);
require_once ("../Vistas/Main_vista.php");

?>