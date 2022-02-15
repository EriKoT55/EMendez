<?php
error_reporting(0);
require_once ("../Modelos/Register_modelo.php");

$conn= new Register_modelo();

$mail=$_GET["mail"];
$password=$_GET["password"];


$arrBool=[];
if(isset($mail) && isset($password)){

    if($conn->insertUsr($mail,$password)==true){

        $arrBool[]=true;
        echo json_encode($arrBool);

    }else{
        $arrBool[]=false;
       echo json_encode($arrBool);
    }

}else{

    $arrBool[]=false;
   echo json_encode($arrBool);
}



?>