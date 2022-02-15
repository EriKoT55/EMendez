<?php
error_reporting(0);
require_once ("../Modelos/IniSesion_modelo.php");

$conn = new IniSesion_modelo();

$mail=$_GET["mail"];
$password=$_GET["password"];

if(isset($mail) && isset($password)){
    $objArrUser=$conn->getUser($mail,$password);

    echo json_encode($objArrUser);

}

?>