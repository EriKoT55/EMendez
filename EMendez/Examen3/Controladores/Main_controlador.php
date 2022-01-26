<?php
//PARA QUITAR LOS ERRORES DADOS POR EL ISSET AL NO HACER EL INICIO DE SESION
error_reporting(0);
require_once ("../Modelos/Main_modelo.php");
/*
echo "<br>";
echo "<pre>";
var_dump($conn->getCountry($codeRandom));
echo "<br>";
*/
session_start();

//OBLIGO A INICIAR SESSION
if(!isset($_SESSION["Iniciado"])){
    header("Location:../Controladores/IniSesion_controlador.php");
}

//CONEXION AL MODELO MAIN
$conn= new Main_modelo();

//DEVUELVE EL OBJETO PAIS DEL USUARIOID, DADO ALEATORIAMENTE
$countryObjArr=$conn->getCountry($_SESSION["userID"]);

//DEVUELVE LOS OBJETOS PAISES
$countriesObjArr=$conn->getCountries();

/*NO SE COMO HACERLO EN EL CONTROLADOR PARA NO TENER QUE LLAMAR A LA FUNCION EN LA VISTA
foreach ($countriesObjArr as $countries){
  $user[]=$conn->getUserT($countries->getUserid());
}
*/

require_once ("../Vistas/Main_vista.php");
?>