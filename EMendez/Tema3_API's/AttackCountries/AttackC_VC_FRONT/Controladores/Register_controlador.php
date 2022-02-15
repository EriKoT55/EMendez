<?php
error_reporting(0);
$mail = $_POST["mail"];
$password = $_POST["password"];
$confirm= $_POST["confirm"];

if($mail!="" && $password!="" && $confirm!="") {
    if( isset( $mail ) && isset( $password )==isset( $confirm ) ) {

        $api = "http://localhost/EMendez/EMendez/Tema3_API's/AttackCountries/AttackC_MC_BACK/Controladores/Register_controlador.php?mail=" . $mail . "&password=" . $password . "";

        $apiArrBool = json_decode( file_get_contents( $api ), true );

        if( $apiArrBool[0]==true ) {

            header( "Location: ../Controladores/IniSesion_controlador.php" );

        } else {
            echo "<script>
                window.alert('Hubo un error al introducir los datos para el registrarse');
            </script>";
        }

    } else {
        echo "<script>
                window.alert('Hubo un error al introducir los datos para el registrarse');
            </script>";
    }
}
require_once( "../Vistas/Register_vista.php" );
?>