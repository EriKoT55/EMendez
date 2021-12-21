<?php
include_once "Clases/bd.php";

$conn= new bd();
$conn->local();

$asdf=$conn->getMovies();
//Problema debo coger valores de dimensiones muy interiores de un array
//foreach ($asdf as $as => $arr){


        echo "<br>";
        echo "<pre>";
         var_dump($asdf);
        echo "<br>";
        /*foreach ($asdf[0]->getActores() as $actores) {

        echo "<br>";
        echo "<pre>";
        var_dump($actores["personName"]);
        echo "<br>";

     }*/
//}


echo "<br>";
echo "<pre>";
//var_dump($conn->cogerPeliXpers(1));
//echo json_encode($conn->cogerPeliculas(1),JSON_PRETTY_PRINT);
echo "<br>";

?>

