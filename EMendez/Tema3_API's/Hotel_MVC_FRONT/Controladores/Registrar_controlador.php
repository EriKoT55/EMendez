<?php
error_reporting(0);

$user = $_POST["user"];
$correo = $_POST["correo"];
$contra = $_POST["contra"];
$confirm = $_POST["confirm"];

$api="http://localhost/EMendez/Tema3_API's/Hotel_MVC_BACK/Controladores/Registrar_controlador.php?user=".$user."&correo=".$correo."&contra=".$contra."&confirm=".$confirm."";
$iniciado=json_decode(file_get_contents($api),true);


if($contra!="" && $user!="" && $correo!="") {
    if (isset($contra) && isset($user) && isset($correo)) {
        if ($iniciado[0] == true) {
            header("Location: ../Controladores/IniSesion_controlador.php");
            echo "
                 <script>
                     window.alert('El usuario ha sido registrado');
                 </script>";
        } else {
            // EN EL CONTROLADOR NO DEBERIA estar
            echo "
                 <script>
                     window.alert('El usuario ya fue registrado');
                 </script>";

        }
    }
}
require_once( "../Vistas/Registrar_vista.php" );

?>