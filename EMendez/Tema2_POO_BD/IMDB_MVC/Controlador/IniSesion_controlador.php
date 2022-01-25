<?php
require_once ("../Modelo/IniSesion_modelo.php");
session_start();
$conn= new IniSesion_modelo();

$user=$_POST["usuario"];
$correo=$_POST["correo"];
$contra=$_POST["contrasenya"];

/*
$userObjArr=$conn->getUser($userValid,$correoValid,$contraValid);
echo "<br>";
echo "<pre>";
var_dump($userObjArr[0]->getUsuarioID());
echo "<br>";
*/
if($user !="" && $correo !="" && $contra !=""){
if(isset($contra) && isset($correo) && isset($user)){
    $userObjArr=$conn->getUser($user,$correo,$contra);
   if($userObjArr[0]->getUsuarioID()>0){
       $_SESSION["Iniciado"]=true;
       $_SESSION["user"]=$userObjArr[0]->getNomUsuario();
       $_SESSION["userID"]=$userObjArr[0]->getUsuarioID();
    header("Location: ../Controlador/Main_controlador.php");
   }else{
      die("Error al iniciar session");
   }
}else{
    die("Error al iniciar session");
}
}

require_once ("../Vista/IniSesion_vista.php");

?>