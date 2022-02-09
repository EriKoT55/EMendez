<?php
//error_reporting(0);
session_start();
/*
echo "<br>";
echo "<pre>";
var_dump($hotelArrayOBJ);
echo "<br>";
*/

$HotelID = $_GET["HotelID"];
$api="http://localhost/EMendez/Tema3_API's/Hotel_MVC_BACK/Controladores/Hotel_controlador.php?HotelID=".$HotelID."";

if(isset($_GET["cerrarSesion"])){
    session_unset();
    session_destroy();
    header("Location:../Controladores/Hotel_controlador.php?HotelID=".$HotelID."");
}


//SI PONES FALSE DEVOLVERA UN ARRAY DE OBJETOS, SI PONES TRUE DEVOLVERA UN ARRAY ASOCIATIVO
$hotelApiObj=json_decode(file_get_contents($api),false);

require_once( "../Vistas/Hotel_vista.php" );
?>