<?php
//error_reporting(0);
session_start();
require_once( "../Modelos/Reserva_modelo.php" );
/**
 * TENGO PENSADO QUE CUANDO SELECCIONES EL DIA DE ENTRADA, YA NO PUEDAS SELECCIONAR
 * EL DIA ANTERIOR, LO CONSIGO PERO TENGO QUE DARLE AL BOTON DE ENVIAR,
 * ############ COMO HACERLO SIN TENER QUE ENVIARLO ############
 */
$minDate2 = $_GET["entrada"];

$conn = new Reserva_modelo();

//Variables del form
$entrada = $_POST["entrada"];
$salida = $_POST["salida"];
$huespedes = $_POST["huespedes"];

//Variables
$entradaValid = "";
$salidaValid = "";
$huespedesValid = "";

if( $entrada!="" ) {
    if( isset( $entrada ) ) {
        $entradaValid = $entrada;
    } else {
        echo "<script>
                window.alert('Se introdujo mal la fecha de entrada');
            </script>";

    }
}
if( $salida!="" ) {
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

if( $huespedes!="" ) {
    if( isset( $huespedes ) ) {
        if( $huespedes < 99 ) {
            $huespedesValid = $huespedes;
        } else {
            echo "<script>
                window.alert('');
            </script>";
        }
    }
}
/*$result=$conn->ComprobarDisponibilidad($entradaValid,$salidaValid,$_SESSION["hotelID"]);
echo "<br>";
echo "<pre>";
var_dump($result);
echo "<br>";*/
if( $entradaValid!="" && $huespedesValid!="" && $salidaValid!="" ) {
    if( isset( $entradaValid ) && isset( $salidaValid ) && isset( $huespedesValid ) ) {
        $objHabitacion = $conn->ComprobarDisponibilidad( $entradaValid, $salidaValid, $_SESSION["hotelID"] );
        $habitacionID = $objHabitacion[0]->getHabitacionID();
        $numHabitacion = $objHabitacion[0]->getNumHabitacion();
        //$habitacionIdRand=rand(1,count($habitacionID)); NO FUNCIONARIA PORQUE DEVUELVE NUMEROS QUE NO SON CONSECUTIVOS
        //$numHabitacionRank=rand();
        if( $habitacionID > 0 ) {
            // DA FALSE AL INSERTAR COMPROBAR PORQUE PETA EN ESTA PARTE
            if( $conn->InsertReserv( $entradaValid, $salidaValid, $habitacionID, $_SESSION["userID"], $huespedesValid ) ) {

                echo "<script>
                        window.alert(" . $numHabitacion . ");
                    </script>";

                header( "Location: ../Controladores/Main_controlador.php" );

            } else {
                echo "<script>
                    window.alert('No hay disponibilidad para esas fechas');
                </script>";
            }
        }
    }
}
require_once( "../Vistas/Reserva_vista.php" );
?>