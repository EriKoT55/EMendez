<?php
error_reporting(0);
require_once( "../Modelos/IniSesion_modelo.php" );

$conn = new IniSesion_modelo();

// Variables del form

$user = $_GET["usuario"];
$correo = $_GET["correo"];
$contra = $_GET["contrasenya"];

// Variables
$userValid = "";
$correoValid = "";
$contraValid = "";

if( isset( $user ) ) {
    if( strlen( $user ) < 50 ) {
        $userValid = $user;
    } else {
        echo "<script>

                window.alert('');
    
            </script>";
    }
}

if( isset( $correo ) ) {
    if( strlen( $correo ) < 100 ) {
        $correoValid = $correo;
    } else {
        echo "<script>

                window.alert('');
    
            </script>";
    }
}

if( isset( $contra ) ) {
    if( strlen( $contra ) < 65 ) {
        $contraValid = $contra;
    } else {
        echo "<script>

                window.alert('');
    
            </script>";
    }
}

if( isset( $user ) && isset( $correo ) && isset( $contra ) ) {
    if( isset( $userValid ) && isset( $correoValid ) && isset( $contraValid ) ) {
        $userObjArr=$conn->existUsr( $userValid, $correoValid, $contraValid);


            //$user=$conn->UsrID($userValid);


            echo json_encode($userObjArr);



    }
}

//require_once( "../../Hotel_MVC_FRONT/Vistas/IniSesion_vista.php" );

?>