<?php
error_reporting(0);
session_start();

if(!isset($_SESSION["Iniciada"])) {
    header("Location: ../Controladores/IniSesion_controlador.php");
}

$mail=$_SESSION["mail"];
$userID=$_SESSION["userID"];
$password=$_SESSION["password"];
$action=$_GET["action"] ?? "";
$Code=$_GET["Code"] ?? "";

$api="http://localhost/EMendez/EMendez/Tema3_API's/AttackCountries/AttackC_MC_BACK/Controladores/Main_controlador.php?mail=".$mail."&userID=".$userID."&password=".$passowrd."&action=".$action."&Code=".$Code."";

//SI NO PONES NADA ES NO ASSOCIATIVO POR DEFECTO, QUIERE DECIR: OBJETO

$arrObjs=json_decode(file_get_contents($api));

/*
echo "<br>";
echo "<pre>";
var_dump($arrObjs);
echo "<br>";
*/

$objArrCountries=$arrObjs->Countries;
$objArrCountriesUsr=$arrObjs->CountriesUser;

require_once ("../Vistas/Main_vista.php");
?>