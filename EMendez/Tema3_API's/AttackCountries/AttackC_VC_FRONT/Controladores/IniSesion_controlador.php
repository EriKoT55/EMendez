<?php
error_reporting(0);
session_start();

$mail=$_POST["mail"];
$password=$_POST["password"];

if($mail!="" && $password!="") {
    if( isset( $mail ) && isset( $password ) ) {

        $api = "http://localhost/EMendez/EMendez/Tema3_API's/AttackCountries/AttackC_MC_BACK/Controladores/IniSesion_controlador.php?mail=" . $mail . "&password=" . $password . "";

        $objArrUserApi = json_decode( file_get_contents( $api ), false );

        if( intval( $objArrUserApi->Id ) > 0 ) {

            $_SESSION["mail"]=$objArrUserApi->Mail;
            $_SESSION["userID"]=$objArrUserApi->Id;
            $_SESSION["password"]=$objArrUserApi->Password;
            $_SESSION["Iniciada"]=true;

            header( "Location: ../Controladores/Main_controlador.php" );

        } else {
            echo "<script>
                window.alert('Hubo un error al introducir los datos');
            </script>";
        }
    } else {
        echo "<script>
                window.alert('Hubo un error al introducir los datos');
            </script>";
    }
}
require_once ("../Vistas/IniSesion_vista.php");
?>