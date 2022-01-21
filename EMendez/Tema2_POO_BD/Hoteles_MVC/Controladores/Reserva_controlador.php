<?php
session_start();
require_once ("../Modelos/Reserva_modelo.php");
/**
 * TENGO PENSADO QUE CUANDO SELECCIONES EL DIA DE ENTRADA, YA NO PUEDAS SELECCIONAR
 * EL DIA ANTERIOR, LO CONSIGO PERO TENGO QUE DARLE AL BOTON DE ENVIAR,
    ############ COMO HACERLO SIN TENER QUE ENVIARLO ############
 */
$minDate2=$_GET["entrada"];

$conn= new Reserva_modelo();

//Variables del form
$entrada=$_GET["entrada"];
$salida=$_GET["salida"];
$huespedes=$_GET["huespedes"];

//Variables
$entradaValid="";
$salidaValid="";
$huespedesValid="";

if(isset($entrada)){
    if(isset($entrada)){
        $entradaValid=$entrada;
    }else{
        echo "<script>
                window.alert('');
            </script>";

    }
}

if(isset($salida)){
    if($salida>=$entradaValid){
        $salidaValid=$salida;
    }else{
        echo "<script>
                window.alert('Se introdujo una fecha incorrecta');
            </script>";
    }
}

if(isset($huespedes)){
    if(count($huespedes)<99){
        $huespedesValid=$huespedes;
    }else {
        echo "<script>
                window.alert('');
            </script>";
    }
}

if(isset($entrada) && isset($salida) && isset($huespedes)){
    if(isset($entradaValid) && isset($salidaValid) && isset($huespedesValid)){
        if($conn->ComprobarDisponibilidad($entradaValid,$salidaValid,$_SESSION["hotelID"],$huespedesValid)){
            if($conn->InsertReserv($entradaValid,$salidaValid,"",$_SESSION["userID"],$huespedesValid)){
                header("Location: ../Controladores/Main_controlador.php");
            }
        }else{
            echo "<script>
                    window.alert('No hay disponibilidad para esas fechas');
                </script>";
        }

    }
}

require_once ("../Vistas/Reserva_vista.php");
?>