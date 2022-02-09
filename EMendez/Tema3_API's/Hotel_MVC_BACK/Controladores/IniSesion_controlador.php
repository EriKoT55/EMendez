<?php
error_reporting(0);
require_once( "../Modelos/IniSesion_modelo.php" );

$conn = new IniSesion_modelo();


// Variables del form
$user = $_POST["usuario"];
$correo = $_POST["correo"];
$contra = $_POST["contrasenya"];

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
        if( $conn->existUsr( $userValid, $correoValid, $contraValid ) ) {

            $userID=$conn->UsrID($userValid);
            $ini=[];
            $ini=[$userID[0]["UsuarioID"],$userValid,true];
//MIRAR NECESITO EL LINK
            echo json_encode($ini);

        } else {
            echo json_encode(false);
        }

    } else{
        echo json_encode(false);
    }
}



?>