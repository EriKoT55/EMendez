<?php
error_reporting(0);
session_start();

$user = $_POST["usuario"];
$correo = $_POST["correo"];
$contra = $_POST["contrasenya"];
/*INTENTAR CONSEGUIR NO MANDAR LA CONTRASEÑA EN TEXTO PLANO*/
//https://es.stackoverflow.com/questions/86963/encriptar-datos-sensibles-en-local
//https://techdocs.broadcom.com/es/es/ca-enterprise-software/business-management/ca-service-management/17-2/creaci_n/construcci_n-de-ca-service-desk-manager/api-rest-de-ca-sdm/c_mo-utilizar-la-autenticaci_n-de-la-clave-secreta-con-la-api-de-rest.html
$api="https://localhost/EMendez/EMendez/Tema3_API's/Hotel_MVC_BACK/Controladores/IniSesion_controlador.php?usuario=".$user."&correo=".$correo."&contrasenya=".$contra."";

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