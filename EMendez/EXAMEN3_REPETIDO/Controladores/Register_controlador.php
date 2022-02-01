<?php
require_once( "../Modelos/Register_modelo.php" );
error_reporting(0);
$conn = new Register_modelo();



$email = $_POST["mail"];
$password = $_POST["password"];
$confirm=$_POST["confirm"];

if( $email!="" && $password!="" && $confirm!="" ) {
    if( isset( $email ) && isset( $password )==isset($confirm) ) {
        if( $conn->insertUsr( $email, $password )==true) {

            header("Location: ../Controladores/Login_controlador.php");
        } else {
            echo "<script>
                window.alert('ERROR EN AL INTRODUCIR LOS DATOS');
            </script>";
        }
    } else {
        echo "<script>
                window.alert('ALGUNO DE LOS DATOS NO FUE INTRODUCIDO');
            </script>";
    }
}

require_once( "../Vistas/Register_vista.php" );
?>