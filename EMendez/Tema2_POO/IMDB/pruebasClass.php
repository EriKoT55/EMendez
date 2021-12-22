<?php
include_once "Clases/bd.php";

$conn= new bd();
$conn->local();

$asdf=$conn->cogerPelicula(2);
//Problema debo coger valores de dimensiones muy interiores de un array
foreach ($asdf as $as => $arr){


        echo "<br>";
        echo "<pre>";
         var_dump($arr);
        echo "<br>";

   /* foreach ($arr->getActores() as $actores) {

        echo "<br>";
        echo "<pre>";
        echo $actores["NombreCompleto"];
        echo "<br>";

    }*/
}


echo "<br>";
echo "<pre>";
//var_dump($conn->cogerPeliXpers(1));
//echo json_encode($conn->cogerPeliculas(1),JSON_PRETTY_PRINT);
echo "<br>";

?>

