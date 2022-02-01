<?php
require_once ("../Modelos/Login_modelo.php");
error_reporting(0);

$conn= new Login_modelo();

session_start();

if($_POST["mail"]!="" && $_POST["password"]!="") {
    if(isset($_POST["password"]) && isset($_POST["mail"])) {
        $objUsr=$conn->getUsr($_POST["mail"],$_POST["password"]);
        if($objUsr->getId()>0){

            $_SESSION["Iniciada"]=true;
            $_SESSION["mail"]=$objUsr->getMail();
            $_SESSION["userID"]=$objUsr->getId();

            header("Location: ../Controladores/Main_controlador.php");
        }else{
            echo "<script>
                window.alert('ERROR, AL INTRODUCIR LOS DATOS)');
            </script>";

        }
    }
}

require_once ("../Vistas/Login_vista.php");
?>