<?php
error_reporting(0);
session_start();

$user = $_POST["usuario"];
$correo = $_POST["correo"];
$contra = $_POST["contrasenya"];

$api="http://localhost/EMendez/Tema3_API's/Hotel_MVC_BACK/Controladores/IniSesion_controlador.php?usuario=".$user."&correo=".$correo."&contrasenya=".$contra."";

$userObjArr=json_decode(file_get_contents($api),false);

if($contra!="" && $user!="" && $correo!="") {
    if (isset($user) && isset($correo) && isset($contra)) {
        if ($userObjArr->UsuarioID > 0) {

            $_SESSION["Ini"] = true;
            $_SESSION["user"] = $userObjArr->Nombre;
            $_SESSION["userID"] = $userObjArr->UsuarioID;

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