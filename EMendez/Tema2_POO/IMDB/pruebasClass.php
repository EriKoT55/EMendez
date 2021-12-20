<?php
include_once "Clases/bd.php";

$conn= new bd();
$conn->local();

$asdf=$conn->cogerPeliculas(1);
//Problema debo coger valores de dimensiones muy interiores de un array
foreach ($asdf as $as => $arr){


        echo "<br>";
        echo "<pre>";
         var_dump($arr->getPeliculaID);
        echo "<br>";

//foreach ($arr->getIMG() as $img =>$value) {

        echo "<br>";
        echo "<pre>";
        echo $arr->getDirectores()[0]["Nombre"];
        echo "<br>";

//}
    }


echo "<br>";
echo "<pre>";
//var_dump($conn->cogerPeliXpers(1));
//echo json_encode($conn->cogerPeliculas(1),JSON_PRETTY_PRINT);
echo "<br>";

?>

