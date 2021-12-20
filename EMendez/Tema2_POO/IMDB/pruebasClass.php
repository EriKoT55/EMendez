<?php
include_once "Clases/bd.php";

$conn= new bd();
$conn->server();

$asdf=$conn->cogerPeliculas();
//Problema debo coger valores de dimensiones muy interiores de un array
foreach ($asdf as $as => $arr){


        echo "<br>";
        echo "<pre>";
        echo $arr->getNombre();
        echo "<br>";

//foreach ($arr as $img =>$value) {
        echo "<br>";
        echo "<pre>";
        var_dump($value->getIMG());
        echo "<br>";
//}
    }


echo "<br>";
echo "<pre>";
//var_dump($conn->cogerPeliculas());
//echo json_encode($conn->cogerPeliculas(1),JSON_PRETTY_PRINT);
echo "<br>";

?>

