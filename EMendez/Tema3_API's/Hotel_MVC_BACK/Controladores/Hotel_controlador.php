<?php

error_reporting(0);
require_once( "../Modelos/Hotel_modelo.php" );

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

echo json_encode($hotelArrayOBJ);

?>