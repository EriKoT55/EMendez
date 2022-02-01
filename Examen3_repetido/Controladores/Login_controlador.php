<?php
require_once ("../Modelos/Login_modelo.php");

session_start();
$conn= new Login_modelo();


if($_POST["mail"]!="" && $_POST["password"]!=""){
    if(isset($_POST["mail"]) && isset($_POST["password"])){
       $objArrUsr= $conn->getUsr($_POST["mail"],$_POST["password"]);
        if($objArrUsr->getUserId()>0){

            $_SESSION["Iniciada"]=true;
            $_SESSION["userMail"]=$objArrUsr->getMail();
            $_SESSION["userID"]=$objArrUsr->getUserId();

            header("Location: ../Controladores/Main_controlador.php");
        }else{
            echo "MAL, error";
        }

    }else{
        echo "mal, introduce todos los datos";
    }
}


require_once ("../Vistas/Login_vista.php");
?>