<?php
//error_reporting(0);

require_once( "../Modelos/Reserva_modelo.php" );
/**
 * TENGO PENSADO QUE CUANDO SELECCIONES EL DIA DE ENTRADA, YA NO PUEDAS SELECCIONAR
 * EL DIA ANTERIOR, LO CONSIGO PERO TENGO QUE DARLE AL BOTON DE ENVIAR,
 * ############ COMO HACERLO SIN TENER QUE ENVIARLO ############
 */

$conn = new Reserva_modelo();

//Variables del form
$entrada = $_GET["entrada"];
$salida = $_GET["salida"];
$huespedes = $_GET["huespedes"];

//Variables
$entradaValid = 0;
$salidaValid = 0;
$huespedesValid = 0;

if( $entrada!=0 ) {
    if( isset( $entrada ) ) {
        $entradaValid = $entrada;
    } else {
        echo "<script>
                window.alert('Se introdujo mal la fecha de entrada');
            </script>";

    }
}
if( $salida!=0 ) {
    if( isset( $salida ) ) {
        if( $salida >= $entradaValid ) {
            $salidaValid = $salida;
        } else {
            echo "<script>
                window.alert('Se introdujo una fecha incorrecta');
            </script>";
        }
    }
}

if( $huespedes!=0 ) {
    if( isset( $huespedes ) ) {
        if( $huespedes < 99 ) {
            $huespedesValid = $huespedes;
        } else {
            echo "<script>
                window.alert('Se excedio el numero de huespedes');
            </script>";
        }
    }
}

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

$numHabYbool=[];

if( $entradaValid!=0 && $huespedesValid!=0 && $salidaValid!=0 ) {
    if( isset( $entradaValid ) && isset( $salidaValid ) && isset( $huespedesValid ) ) {
        /** SI NO HAY NINGUNA RESERVA ENTRE ESOS DIAS TODA VA BIEN, PERO SI HAY ALGUNA LA PANTALLA SE MUESTRA EN BLACO, MIRAR FUNCION COMPROBAR*/
        $objHabitacion = $conn->ComprobarDisponibilidad( $entradaValid, $salidaValid, $_SESSION["hotelID"] );

        $habitacionID = [];
        foreach($objHabitacion as $habitaciones){
            $habitacionID[]=$habitaciones->getHabitacionID();
        }
        $randHab=rand(0,(count($habitacionID)-1));

        if( $habitacionID[$randHab] > 0 ) {

            $arrNum=$conn->numHabitacion($habitacionID[$randHab]);

            $numHabYbool=[$arrNum["numHabitacion"],true];
            echo json_encode($numHabYbool);

        }else {
            $numHabYbool=[false];
            echo json_encode($numHabYbool);
        }
    }
}

?>