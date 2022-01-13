<?php
require_once("Hotel_contolador.php");
$conn=new Hotel_modelo();

//EL ID LO PASO DEL GET DE Main_modelo
$HotelID=$_GET["HotelID"];
if(isset($HotelID)){
    $hotel=$conn->getHotel($HotelID);
}

require_once ("pagHotel_vista.php");
?>
