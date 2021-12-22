<?php
include_once "Clases/bd.php";

$conn= new bd();
$conn->local();

$asdf=$conn->cogerPelicula(1);
//Problema debo coger valores de dimensiones muy interiores de un array



        /*echo "<br>";
        echo "<pre>";
         var_dump($asdf);
        echo "<br>";*/

    foreach ($asdf[0]->getIMG() as $img) {

        echo "<br>";
        echo "<pre>";
        var_dump( $img);
        echo "<br>";

    }



echo "<br>";
echo "<pre>";
//var_dump($conn->cogerPeliXpers(1));
//echo json_encode($conn->cogerPeliculas(1),JSON_PRETTY_PRINT);
echo "<br>";

?>

