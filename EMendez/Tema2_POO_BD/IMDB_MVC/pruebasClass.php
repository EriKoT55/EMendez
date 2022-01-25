<?php
include_once "Clases/bd.php";
//session_start();
$conn= new bd();
$conn->local();
$asdf=$conn->insertCalificacion(7.2,1,2);


//$bool=$_SESSION["Ini"];


//Problema debo coger valores de dimensiones muy interiores de un array
//foreach ($asdf as $as => $arr){


        /*echo "<br>";
        echo "<pre>";
         var_dump($arr);
        echo "<br>";*/

/*    foreach ($asdf as $pers) {

        echo "<br>";
        echo "<pre>";
        var_dump($pers);
        echo "<br>";

    }*/
//}


echo "<br>";
echo "<pre>";
//var_dump($conn->cogerPeliXpers(1));
//echo json_encode($conn->cogerPeliculas(1),JSON_PRETTY_PRINT);
echo "<br>";

?>

