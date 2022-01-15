<?php
error_reporting(0);
require_once( "../Modelos/IniSesion_modelo.php" );
session_start();
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

            $_SESSION["Ini"]=true;
            $_SESSION["user"]=$userValid;
            $_SESSION["userID"]=$userID[0]["UsuarioID"];

            header( "Location: ../Controladores/Main_controlador.php" );
        } else {
            echo "<script>

                window.alert('Algunos de los datos no son correctos');
    
            </script>";
        }

    } else {
        echo "<script>

                window.alert('Algunos de los datos no son correctos');
    
            </script>";
    }
}

require_once( "../Vistas/IniSesion_vista.php" );
?>