<?php
require_once ("../Modelo/Register_modelo.php");

$conn=new Register_modelo();

$user=$_POST["user"];
$correo=$_POST["correo"];
$contra=$_POST["contra"];
$confirmContra=$_POST["confirm"];

if(isset($user) && isset($correo) && isset($contra) == isset($confirmContra)){
    $contraValid=password_hash($contra,PASSWORD_DEFAULT);
    if($conn->insertUser($user,$correo,$contraValid)){
        header("Location:../Controlador/IniSesion_controlador.php");
    }else{
        die("ERROR AL REGISTRARSE");
    }
}

require_once ("../Vista/Register_vista.php");
?>