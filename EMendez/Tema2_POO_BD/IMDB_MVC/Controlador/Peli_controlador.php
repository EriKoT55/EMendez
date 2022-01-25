<?php
require_once ("../Modelo/Peli_modelo.php");

error_reporting(0);

session_start();
$conn= new Peli_modelo();


$PeliculaID = $_GET["PeliculaID"];
if (isset($PeliculaID)) {
    $pelicula = $conn->cogerPelicula($PeliculaID);
}

if(isset($_GET["cerrarSesion"])){
    session_unset();
    session_destroy();
    header("Location:../Controlador/Peli_controlador.php?HotelID=".$PeliculaID."");
    //No funciona ni con $PeliculaID, PREGUNTAR
    //header("Location:PagPeli.php?PeliculaID=".$pelicula[0]->getPeliculaID());
}


$_SESSION["peliID"]=$pelicula[0]->getPeliculaID();


require_once ("../Vista/Peli_vista.php");
?>