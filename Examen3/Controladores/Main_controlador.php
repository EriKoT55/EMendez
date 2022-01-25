<?php
require_once ("../Modelos/Main_modelo.php");
session_start();

$conn= new Main_modelo();
//RANDOMIZA EL PAIS PARA EL USUSARIO
$codeRandom=$conn->randomCountry()[0]["Code"];
/*
echo "<br>";
echo "<pre>";
var_dump($conn->getCountry($codeRandom));
echo "<br>";
*/
require_once ("../Vistas/Main_vista.php");
?>