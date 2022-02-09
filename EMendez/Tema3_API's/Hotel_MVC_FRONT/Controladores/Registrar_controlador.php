<?php
error_reporting(0);
$api="";
$iniciado=json_decode(file_get_contents($api),false);
if($iniciado){
    header("Location: ../Controladores/IniSesion_controlador.php");
    echo "
                 <script>
                     window.alert('El usuario ha sido registrado');
                 </script>";
}else{
        //AQUI DEBERIA PONER UN SCRIPT Y UN ALERT, PERO AL ESTAR EN EL CONTROLADOR NO DEBERIA
        echo "
                 <script>
                     window.alert('El usuario ya fue registrado');
                 </script>";

}

require_once( "../Vistas/Registrar_vista.php" );

?>