<?php
require_once ("../Modelos/Main_modelo.php");
require_once ("../Modelos/IniSesion_modelo.php");

$objArrUser=new User(0,"-","-");
if(isset($_GET["mail"]) && isset($_GET["password"]) ){

    $connIni= new IniSesion_modelo();
    $objArrUser=$connIni->getUser($_GET["mail"],$_GET["password"]);

}
$objArrCountriesAtk=[];
$connMain= new Main_modelo();
$objArrCountries = $connMain->getCountries();

if($objArrUser->getId()>0){
    if(isset($_GET["userID"])) {
        $objArrCountriesUser = $connMain->getCountriesUsr($_GET["userID"]);
        //$arrMail=$connMain->getMailXid($objArrUser->getId());
    }

    if(isset($_GET["action"]) && isset($_GET["Code"])){
        if($_GET["action"]==true) {
            $objArrCountriesAtk = $connMain->getCountryAtk( $_GET["Code"] );

            //MIRAR PETA AQUI

            $populationATK=0;
            $gnpATK=0;
            foreach($objArrCountriesAtk as $countriesATK){

                $populationATK+=$countriesATK->getPopulation();
                $gnpATK+=$countriesATK->getGNP();

            }

            $fuerzaATK=$populationATK+$gnpATK;

            $populationUsr=0;
            $gnpUsr=0;

            foreach($objArrCountriesUser as $countriesUsr){

                $populationUsr+=$countriesUsr->getPopulation();
                $gnpUsr+=$countriesUsr->getGNP();

            }
            $fuerzaUsr=$populationUsr+$gnpUsr;

            if($fuerzaUsr>$fuerzaATK){
               $connMain->updATKCountry($_GET["userID"],$_GET["Code"]);
            }
            $objArrCountriesUser = $connMain->getCountriesUsr($_GET["userID"]);
        }
    }

}

$arrObjs=[
    "Countries"=>$objArrCountries,
    "CountriesUser"=>$objArrCountriesUser
];

echo json_encode($arrObjs);


?>