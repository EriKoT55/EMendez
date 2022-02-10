<?php
error_reporting(0);
session_start();

$user = $_POST["usuario"];
$correo = $_POST["correo"];
$contra = $_POST["contrasenya"];

$api="http://localhost/EMendez/Tema3_API's/Hotel_MVC_BACK/Controladores/IniSesion_controlador.php?usuario=".$user."&correo=".$correo."&contrasenya=".$contra."";

$iniciada=json_decode(file_get_contents($api),true);
//var_dump($iniciada);

if($contra!="" && $user!="" && $correo!="") {
    if (isset($user) && isset($correo) && isset($contra)) {
        if ($iniciada[2] == true) {

            $_SESSION["Ini"] = true;
            $_SESSION["user"] = $iniciada[1];
            $_SESSION["userID"] = $iniciada[0];

            header("Location: ../Controladores/Main_controlador.php");
        } else {
            echo "<script>

            window.alert('Algunos de los datos no son correctos');
    
        </script>";
        }
    }
}

require_once( "../Vistas/IniSesion_vista.php" );

?>