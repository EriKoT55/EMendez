<?php
error_reporting( 0 );
session_start();

/**
 * TENGO PENSADO QUE CUANDO SELECCIONES EL DIA DE ENTRADA, YA NO PUEDAS SELECCIONAR
 * EL DIA ANTERIOR, LO CONSIGO PERO TENGO QUE DARLE AL BOTON DE ENVIAR,
 * ############ COMO HACERLO SIN TENER QUE ENVIARLO ############
 */

//Variables del form
$entrada = $_GET["entrada"];
$salida = $_GET["salida"];
$huespedes = $_GET["huespedes"];
$hotelID = $_SESSION["hotelID"];
$userID = $_SESSION["userID"];

//PREGUNTAR SI HAY UNA MANERA DE HACERLO MENOS CHAPUCERA QUE ESTA
$api = "http://localhost/EMendez/EMendez/Tema3_API's/Hotel_MVC_BACK/Controladores/Reserva_controlador.php?entrada=" . $entrada . "&salida=" . $salida . "&huespedes=" . $huespedes . "&hotelID=" . $hotelID . "&userID=" . $userID . "";


$numReserv_y_bol = json_decode( file_get_contents( $api ), true );

/*$result=$conn->ComprobarDisponibilidad($entradaValid,$salidaValid,$_SESSION["hotelID"]);

            //PROBAR SI DEVUELVE UN OBJETO VACIO HACER UN FOR EACH
$habitacionID=[];
foreach($result as $resu) {

    $habitacionID[]=$resu->getHabitacionID();
}
$randHab=rand(0,count($habitacionID));
echo "<br>";
echo "<pre>";
var_dump($habitacionID[$randHab]);
echo "<br>";*/


if( $entrada!=0 && $huespedes!=0 && $salida!=0 ) {
    if( isset( $entrada ) && isset( $salida ) && isset( $huespedes ) ) {

        if( $numReserv_y_bol[1]==true ) {
            /** ME GUSTARIA MOSTRAR EL NUMERO Y LLEVAR DESPUES AL INICIO */
            //HACE UNA COSA U OTRA PERO NO LAS DOS

            header( "Location: ../Controladores/Main_controlador.php" );
            echo "<script>
                     window.alert(" . $numReserv_y_bol[0] . ");
                </script>";
        } else {
            echo "<script>
                    window.alert('No hay disponibilidad para esas fechas');
                </script>";
        }
    } else {
        echo "<script>
                    window.alert('No hay disponibilidad para esas fechas');
                </script>";
    }
}

require_once( "../Vistas/Reserva_vista.php" );
?>