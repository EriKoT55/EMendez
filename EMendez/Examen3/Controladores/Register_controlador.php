<?php
require_once ("../Modelos/Register_modelo.php");

$conn= new Register_modelo();

$mail=$_POST["mail"];
$passw=$_POST["password"];
$repeat=$_POST["repeat"];

//REALIZO ESTE IF A PARA NO RECIBIR ERRORES Y QUE NO PETE
if($mail!="" && $passw!="" && $repeat!=""){
    if(isset($mail) && isset($passw)==isset($repeat)){
        $passwHash=password_hash($passw,PASSWORD_DEFAULT);
        if($conn->insertUser($mail,$passwHash)){
            header("Location:../Controladores/IniSesion_controlador.php");
        }else{
            //CAMBIAR die POR UN echo SI PETA
            die("ERROR al hacer el registro");
        }
    }
}
require_once ("../Vistas/Register_vista.php");
?>