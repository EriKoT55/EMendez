<?php
error_reporting(0);
require_once( "../Modelos/Registrar_modelo.php" );

$conn= new Registrar_modelo();

//Variables del form
$user = $_POST["user"];
$correo = $_POST["correo"];
$contra = $_POST["contra"];
$confirm = $_POST["confirm"];

//Variables en las cuales guardar las respectivas variables anteriores
$usrValid = "";
$correoValid = "";
$contraValid = "";

if(isset($user)){
    if(strlen($user)<50){
        $usrValid=$user;
    }else{
        //AQUI DEBERIA PONER UN SCRIPT Y UN ALERT, PERO AL ESTAR EN EL CONTROLADOR NO DEBERIA
        echo "
                 <script>
                     window.alert('El nombre de usuario no debe pasar de 50 caracteres');
                 </script>
             ";
    }
}

if(isset($correo)){
    if(strlen($correo)<100){
        $correoValid=$correo;
    }else{
        //AQUI DEBERIA PONER UN SCRIPT Y UN ALERT, PERO AL ESTAR EN EL CONTROLADOR NO DEBERIA
        echo "
                 <script>
                     window.alert('El correo no puede pasar de 100 caracteres');
                 </script>";
    }
}

if(isset($contra)){
    if(isset($contra) && isset($confirm)){
        if($confirm==$contra && strlen($contra)<65 && strlen($confirm)<65){
            $contraValid=password_hash($contra,PASSWORD_DEFAULT);
        }else{
            //AQUI DEBERIA PONER UN SCRIPT Y UN ALERT, PERO AL ESTAR EN EL CONTROLADOR NO DEBERIA
            echo "
               <script>
                     window.alert('La contraseña no coincide y/o no puede pasar de 100 caracteres');
                </script>";
        }
    }
}

if(isset($contra) && isset($user) && isset($correo)){
    if(isset($correoValid) && isset($contraValid) && isset($usrValid)){
        if($conn->InsertUsuario($usrValid,$correoValid,$contraValid)){
            //NO SE SI FUNCIONARA MIRAR
            echo json_encode(true);

        }else{

            echo json_encode(false);

        }
    }
}



?>