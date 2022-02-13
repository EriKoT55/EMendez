<?php
error_reporting( 0 );
session_start();
//Quitar uno EMendez en clase añadir uno en casa
$api="http://localhost/EMendez/EMendez/Tema3_API's/Hotel_MVC_BACK/Controladores/Main_controlador.php";

if( isset( $_GET["cerrarSesion"] ) ) {
    session_unset();
    session_destroy();
}

$hotelApiObj=json_decode(file_get_contents($api));
//var_dump($hotelApiObj);
/*
foreach ($hotelApiObj as $hotel){
    var_dump($hotel);
    /*foreach($hotel->IMG[0] as $img){
        var_dump($img);
    }
}*/

require_once( "../Vistas/Main_vista.php");

?>