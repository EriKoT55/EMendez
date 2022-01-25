<?php
require_once ("../Modelo/IniSesion_modelo.php");

$conn= new IniSesion_modelo();

$user=$_POST["usuario"];
$correo=$_POST["correo"];
$contra=$_POST["contrasenya"];


$userValid="";
$correoValid="";
$contraValid="";

if(isset($user)){
    $userValid=$user;
}

if(isset($correo)){
    $correoValid=$correo;
}

if(isset($contra)){
    $contraValid=$contra;
}

if(isset($contraValid) && isset($correoValid) && isset($userValid)){
   if($conn->getUser($userValid,$correoValid,$contraValid)){
    header("Location:../Controlador/Main_controlador");
   }else{
      // die("Error al iniciar session");
   }

}


require_once ("../Vista/IniSesion_vista.php");
?>