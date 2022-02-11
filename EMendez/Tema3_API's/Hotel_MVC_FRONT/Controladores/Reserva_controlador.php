<?php
//error_reporting(0);
session_start();

/**
 * TENGO PENSADO QUE CUANDO SELECCIONES EL DIA DE ENTRADA, YA NO PUEDAS SELECCIONAR
 * EL DIA ANTERIOR, LO CONSIGO PERO TENGO QUE DARLE AL BOTON DE ENVIAR,
 * ############ COMO HACERLO SIN TENER QUE ENVIARLO ############
 */

//Variables del form
$entrada = $_POST["entrada"];
$salida = $_POST["salida"];
$huespedes = $_POST["huespedes"];


$api="http://localhost/EMendez/Tema3_API's/Hotel_MVC_BACK/Controladores/Reserva_controlador.php?entrada=".$entrada."&salida=".$salida."&huespedes=".$huespedes."";


$objHabitacionApi=json_decode(file_get_contents($api),true);

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

var_dump($objHabitacionApi);

/*
if( $entrada!=0 && $huespedes!=0 && $salida!=0 ) {
    if( isset( $entrada ) && isset( $salida ) && isset( $huespedes ) ) {
        /** SI NO HAY NINGUNA RESERVA ENTRE ESOS DIAS TODA VA BIEN, PERO SI HAY ALGUNA LA PANTALLA SE MUESTRA EN BLANCO, MIRAR FUNCION COMPROBAR*/
/*
            if( $objHabitacionApi[1]==true ) {
/** ME GUSTARIA MOSTRAR EL NUMERO Y LLEVAR DESPUES AL INICIO *//*

                echo "<script>
                     window.alert(".$objHabitacionApi[0].");
                </script>";

        //header( "Location: ../Controladores/Main_controlador.php" );
            } else {
                echo "<script>
                    window.alert('No hay disponibilidad para esas fechas');
                </script>";
            }
        }else {
            echo "<script>
                    window.alert('No hay disponibilidad para esas fechas');
                </script>";
        }
}*/

require_once( "../Vistas/Reserva_vista.php" );
?>