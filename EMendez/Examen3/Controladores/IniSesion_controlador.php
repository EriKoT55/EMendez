<?php
require_once ("../Modelos/IniSesion_modelo.php");
session_start();
$conn= new IniSesion_modelo();

$mail=$_POST["mail"];
$password=$_POST["password"];

//$userObjArr=$conn->getUser($mail,$password);
/*
echo "<br>";
echo "<pre>";
var_dump($userObjArr);
echo "<br>";
*/
if($mail!="" && $password!= ""){
    if(isset($mail) && isset($password)){
        $userObjArr=$conn->getUser($mail,$password);

        if($userObjArr[0]->getId()>0){

            $_SESSION["Iniciado"]=true;
            $_SESSION["user"]=$userObjArr[0]->getMail();
            $_SESSION["userID"]=$userObjArr[0]->getId();

            header("Location:../Controladores/Main_controlador.php");

        }else{
           echo "error";
        }

    }
}

require_once ("../Vistas/IniSesion_vista.php");
?>