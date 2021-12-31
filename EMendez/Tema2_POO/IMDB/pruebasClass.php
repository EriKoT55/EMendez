<?php
include_once "Clases/bd.php";
//session_start();
$conn= new bd();
$conn->local();
$asdf=$conn->cogerPelicula(1);


//$bool=$_SESSION["Ini"];


//Problema debo coger valores de dimensiones muy interiores de un array
//foreach ($asdf as $as => $arr){


        /*echo "<br>";
        echo "<pre>";
         var_dump($arr);
        echo "<br>";*/

    foreach ($asdf as $arr) {

        foreach($arr->getComentarios() as $coment) {
            echo "<br>";
            echo "<pre>";
            var_dump( $coment);
            echo "<br>";
        }
        foreach($arr->getFechaComent() as $fecha) {
            echo "<br>";
            echo "<pre>";
            var_dump( $fecha );
            echo "<br>";
        }
    }
//}


echo "<br>";
echo "<pre>";
//var_dump($conn->cogerPeliXpers(1));
//echo json_encode($conn->cogerPeliculas(1),JSON_PRETTY_PRINT);
echo "<br>";

?>

