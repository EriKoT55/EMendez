<?php
require_once ("../Modelos/Main_modelo.php");
//error_reporting(0);
session_start();

/*foreach ($conn->getFilms() as $films){
    echo "<br>";
    echo "<pre>";
    var_dump($films->getLenght());
    echo "<br>";
}*/

//if($_SESSION["Iniciada"]!=""){
    if(!isset($_SESSION["Iniciada"])){
        header("Location: ../Controladores/Login_controlador.php");
    }
//}

$conn= new Main_modelo();
$objArrFilms=$conn->getFilms();

$objArrFilmsUsr=$conn->getFilmsUsr($_SESSION["userID"]);


if(isset($_GET["reserv"])==true && isset($_GET["filmID"])){

        $conn->reserPeli($_SESSION["userID"],$_GET["filmID"]);

}

$objArrFilmsUsr=$conn->getFilmsUsr($_SESSION["userID"]);

if(isset($_GET["devolver"])==true && isset($_GET["filmID"])){

    $conn->devolverPeli($_GET["filmID"]);

}
$objArrFilmsUsr=$conn->getFilmsUsr($_SESSION["userID"]);
require_once ("../Vistas/Main_vista.php");
?>