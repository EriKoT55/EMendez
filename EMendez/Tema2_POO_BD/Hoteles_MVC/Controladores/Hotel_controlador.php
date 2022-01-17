<?php

error_reporting(0);
require_once( "../Modelos/Hotel_modelo.php" );
//require_once("../Vistas/pagMain_vista.php");
session_start();

$conn = new Hotel_modelo();

//EL ID LO PASO DEL GET DE Main_modelo
$HotelID = $_GET["HotelID"];
if( isset( $HotelID ) ) {
    $hotelArrayOBJ = $conn->getHotel( $HotelID );
}

/*
echo "<br>";
echo "<pre>";
var_dump($hotelArrayOBJ);
echo "<br>";
*/
if(isset($_GET["cerrarSesion"])){
    session_unset();
    session_destroy();
    header("Location:../Controladores/Hotel_controlador.php?HotelID=".$HotelID."");
}

require_once( "../Vistas/Hotel_vista.php" );
?>