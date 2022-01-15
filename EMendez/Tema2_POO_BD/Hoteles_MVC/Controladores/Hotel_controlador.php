<?php
require_once( "../Modelos/Hotel_modelo.php" );
//require_once("../Vistas/pagMain_vista.php");
$conn = new Hotel_modelo();

//EL ID LO PASO DEL GET DE Main_modelo
$HotelID = $_GET["HotelID"];
if( isset( $HotelID ) ) {
    $hotel = $conn->getHotel( $HotelID );
}

require_once( "../Vistas/pagHotel_vista.php" );
?>